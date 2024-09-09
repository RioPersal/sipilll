<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        $data['admin'] = $admins;
        return view('data_admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['action'] = 'admin.store';
        return view('data_admin.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|min:3',
            'username' => 'required|min:3',
            'password' => 'required|min:8',
        ]);

        $admin = new Admin;
        $admin->nama = $request->nama;
        $admin->gelar_depan = $request->gelar_depan;
        $admin->gelar_belakang = $request->gelar_belakang;
        $admin->save();
        
        $admin2 = new User;
        $admin2->name = $request->nama;
        $admin2->username = $request->username;
        $admin2->level = 'admin';
        $admin2->password = Hash::make($request->password);
        $admin2->gelar_depan = $request->gelar_depan;
        $admin2->gelar_belakang = $request->gelar_belakang;
        $admin2->save();

        return redirect('/data-admin')->with('success', 'Data Admin berhasil ditambah!');
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
        $admins = Admin::find($id);
        // dd($admins);
        $user = User::where('name',$admins->nama)->first();
        // dd($user);
        $data['admin'] = $admins;
        return view('data_admin.edit', $data, compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|min:3',
            'username' => 'required|min:3',
            'password' => 'required|min:8',
        ]);
        
        $admin = Admin::find($request->id);
        $admin->nama = $request->nama;
        $admin->gelar_depan = $request->gelar_depan;
        $admin->gelar_belakang = $request->gelar_belakang;
        $admin->save();

        User::where('name', $request->nama)->delete();
        // dd($adminn);

        $admin2 = new User;
        // dd($request->nama);
        $admin2->name = $request->nama;
        $admin2->username = $request->username;
        $admin2->level = 'admin';
        $admin2->password = Hash::make($request->password);
        $admin2->gelar_depan = $request->gelar_depan;
        $admin2->gelar_belakang = $request->gelar_belakang;
        $admin2->save();

        return redirect('/data-admin')->with('success', 'Data Admin berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/data-admin')->with('hapus', 'Data Admin berhasil dihapus!');
    }
}
