<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisUmkm;
use App\Models\Kecamatan;
use App\Models\Umkm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.umkm.index');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Umkm::with(['user', 'kecamatan', 'jenis_umkm'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('jenis_umkm', function ($row) {
                    return $row->jenis_umkm->name;
                })
                ->addColumn('user', function ($row) {
                    return $row->user->username;
                })
                ->addColumn('kecamatan', function ($row) {
                    return $row->kecamatan->name;
                })
                ->editColumn('status', function ($row) {
                    switch ($row->status) {
                        case 0:
                            return '<span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-yellow-100 bg-yellow-600 rounded-full">Menunggu</span>';
                            break;
                        case 1:
                            return '<span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-green-100 bg-green-600 rounded-full">Valid</span>';
                            break;
                        case 2:
                            return '<span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">Tidak Valid</span>';
                            break;

                        default:
                            # code...
                            break;
                    }
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.umkm.edit', $row->id);
                    $action_btn = '
                    <button
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-non disabled:opacity-25 transition ease-in-out duration-150 text-white bg-gray-800 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 lihat" data-id="' . $row->id . '" data-latitude="' . $row->latitude . '" data-longitude="' . $row->longitude . '">
                        Lihat
                    </button>
                    <a href="' . $edit_url . '"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-non focus:ring disabled:opacity-25 transition ease-in-out duration-150 text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                        Edit
                    </a>
                    <button
                        data-id="' . $row->id . '" data-name="' . $row->name . '"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-non focus:ring disabled:opacity-25 transition ease-in-out duration-150 text-white bg-red-600 hover:bg-red-700 focus:ring-red-500 hapus_record">
                        Hapus
                    </button>
                    ';
                    return $action_btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatans = Kecamatan::where('status', 1)->latest()->get();
        $users = User::latest()->get();
        $jenisUmkms = JenisUmkm::where('status', 1)->latest()->get();
        return view('admin.umkm.create', compact('kecamatans', 'users', 'jenisUmkms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'kecamatan_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'jenis_umkm_id' => 'required|numeric',
            'lat' => 'required',
            'lng' => 'required',
            'klasifikasi_umum' => 'required',
            'status_umkm' => 'required',
            // 'photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'photo.*' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);
        if ($request->hasFile('photo')) {
            $umkm = Umkm::create([
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'kecamatan_id' => $request->kecamatan_id,
                'user_id' => $request->user_id,
                'jenis_umkm_id' => $request->jenis_umkm_id,
                'latitude' => $request->lat,
                'longitude' => $request->lng,
                'klasifikasi_umum' => $request->klasifikasi_umum,
                'status_umkm' => $request->status_umkm,
                'status' => 0,
            ]);
            $umkmPhotos = [];
            foreach ($request->file('photo') as $photo) {
                $photo_name = $photo->getClientOriginalName();
                $photo_name = preg_replace('!\s+!', ' ', $photo_name);
                $photo_name = str_replace(' ', '_', $photo_name);
                $photo_name = str_replace('%', '', $photo_name);
                $photo->move(public_path('photo'), $photo_name);
                $umkmPhotos[] = [
                    'umkm_id' => $umkm->id,
                    'photo' => $photo_name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            $umkm->photos()->insert($umkmPhotos);
            return redirect()->route('admin.umkm.index')->with('success', 'UMKM baru berhasil dibuat!');
        } else {
            return redirect()->route('admin.umkm.index')->with('success', 'Upload Foto terlebih dahulu!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $umkm = Umkm::findOrfail($id);
        return view('admin.umkm.show', compact('umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Umkm $umkm)
    {
        $kecamatans = Kecamatan::where('status', 1)->latest()->get();
        $users = User::latest()->get();
        $jenisUmkms = JenisUmkm::where('status', 1)->latest()->get();
        return view('admin.umkm.edit', compact('kecamatans', 'users', 'jenisUmkms', 'umkm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Umkm $umkm)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'kecamatan_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'jenis_umkm_id' => 'required|numeric',
            'lat' => 'required',
            'lng' => 'required',
            'klasifikasi_umum' => 'required',
            'status_umkm' => 'required',
            'photo.*' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:5120',
        ]);
        $photo_name = $umkm->photo;
        if ($request->hasFile('photo')) {
            foreach ($umkm->photos as $key => $photo) {
                if (File::exists(public_path("photo\\" . $photo->photo))) {
                    unlink(public_path("photo\\" . $photo->photo));
                }
            }
            $umkm->photos()->delete();

            foreach ($request->file('photo') as $key => $photo) {
                $photo_name = $photo->getClientOriginalName();
                $photo_name = preg_replace('!\s+!', ' ', $photo_name);
                $photo_name = str_replace(' ', '_', $photo_name);
                $photo_name = str_replace('%', '', $photo_name);
                $photo->move(public_path('photo'), $photo_name);
                $umkmPhotos[] = [
                    'umkm_id' => $umkm->id,
                    'photo' => $photo_name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            $umkm->photos()->insert($umkmPhotos);
        }
        $umkm->update([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'kecamatan_id' => $request->kecamatan_id,
            'user_id' => $request->user_id,
            'jenis_umkm_id' => $request->jenis_umkm_id,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
            'klasifikasi_umum' => $request->klasifikasi_umum,
            'status_umkm' => $request->status_umkm,
        ]);
        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diubah!');
    }

    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $umkm = Umkm::findOrFail($id);
        $umkm->update([
            'status' => $request->status
        ]);
        return redirect()->back()->with('success', 'Status UMKM berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Umkm $umkm)
    {
        foreach ($umkm->photos as $key => $photo) {
            if (File::exists(public_path("photo\\" . $photo->photo))) {
                unlink(public_path("photo\\" . $photo->photo));
            }
        }
        $umkm->photos()->delete();
        $umkm->delete();
        return response()->json(['status' => TRUE]);
    }
}
