<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisUmkm;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisUmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.jenis-umkm.index');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = JenisUmkm::with(['umkm'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return "Tidak Aktif";
                    } else if ($row->status == 1) {
                        return "Aktif";
                    }
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('umkm', function ($row) {
                    return $row->umkm->count();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.jenis-umkm.edit', $row->id);
                    $action_btn = '
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
                ->rawColumns(['action'])
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
        return view('admin.jenis-umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|numeric'
        ]);

        JenisUmkm::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('admin.jenis-umkm.index')->with('success', 'Jenis Umkm baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisUmkm $jenisUmkm)
    {
        return view('admin.jenis-umkm.edit', compact('jenisUmkm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisUmkm $jenisUmkm)
    {

        $request->validate([
            'name' => 'required',
            'status' => 'required|numeric'
        ]);

        $jenisUmkm->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('admin.jenis-umkm.index')->with('success', 'Jenis Umkm berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenisUmkm = JenisUmkm::with(['umkm'])->findOrFail($id);
        if ($jenisUmkm->umkm->count() != 0) {
            return response()->json(['status' => TRUE, 'error' => 'Jika ingin menghapus Jenis Umkm pastikan sudah tidak ada UMKM yang terdaftar pada jenis umkm tersebut!']);
        } else {
            $jenisUmkm->delete();
            return response()->json(['status' => TRUE]);
        }
    }
}
