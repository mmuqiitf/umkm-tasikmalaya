<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    public function list(Request $request)
    {
        // if ($request->ajax()) {
        $data = User::with(['umkm'])->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('umkm', function ($row) {
                return $row->umkm->count();
            })
            ->addColumn('action', function ($row) {
                $edit_url = route('admin.user.edit', $row->id);
                $show_url = route('admin.user.show', $row->id);
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
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'size:16'],
            'phone' => ['required', 'string', 'max:13'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User baru berhasil ditambahkan!');
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
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users,username,' . $user->id . ',id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id . ',id'],
            'address' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'size:16'],
            'phone' => ['required', 'string', 'max:13'],
            'password' => "required|sometimes|confirmed|",
        ]);
        if ($request->has('password') && $request->has('password_confirmation')) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role
            ]);
        }

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with(['umkm'])->findOrFail($id);
        if ($user->umkm->count() != 0) {
            return response()->json(['status' => TRUE, 'error' => 'Jika ingin menghapus User pastikan sudah tidak ada UMKM yang terdaftar pada user tersebut!']);
        } else {
            $user->delete();
            return response()->json(['status' => TRUE]);
        }
    }
}
