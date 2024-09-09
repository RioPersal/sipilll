<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        return view('data_user.index2');
    }

    
    // public function profile()
    // {
    //     return view('profile.index');
    // }

    public function create()
    {
        $data['action'] = 'user.store';
        return view('data_user.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_role' => 'required',
        ]);

        $role = new User;
        $role->kode_role = $request->kode_role;
        $role->save();

        return redirect('/data-role')->with('success', 'Data Role berhasil ditambah!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = User::find($id);
        $data['role'] = $roles;
        // $data['action'] = '/data-dosen/update';
        return view('data_role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $role = User::find($request->id);
        $role->kode_role = $request->kode_role;
        $role->save();
        return redirect('/data-role')->with('success', 'Data Role berhasil diedit!');

        // return redirect()->to('/data-dosen'); 
        // $dosen->update([
            // $dosen->nama = $request->nama,
            // $dosen->nip = $request->nip,
            // $dosen->email= $request->email,
            // $dosen->role_id = $request->role_id,
            // $dosen->password = $request->password,
        // ]);
        // $dosen->nama = $request->input('nama');
        // $dosen->nip = $request->input('nip');
        // $dosen->email= $request->input('email');
        // $dosen->role_id = $request->input('role_id');
        // $dosen->password = $request->input('password');
        // $dosen->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/data-role')->with('hapus', 'Data Role berhasil dihapus!');
    }


}
