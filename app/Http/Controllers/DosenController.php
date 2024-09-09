<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DosenImport;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = Dosen::all();
        $data['dosen'] = $dosens;
        return view('data_dosen.index', $data);
    }

    public function import(Request $request)
    {
        $file = $request->file('excel_file');

        Excel::import(new DosenImport, $file);

        return redirect()->back()->with('success', 'Data Dosen berhasil diimport!');
        // try {
        //     if ($request->hasFile('excel_file')) {
        //     }
    
        //     return redirect()->back()->with('error', 'Tidak ada file excel yang diimport!');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Gagal mengimport file excel!');
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['action'] = 'dosen.store';
        return view('data_dosen.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nidn' => 'required',
            'nama' => 'required|min:3',
        ]);

        $dosen = new Dosen;
        $dosen->nama = $request->nama;
        $dosen->nidn = $request->nidn;
        $dosen->gelar_depan = $request->gelar_depan;
        $dosen->gelar_belakang = $request->gelar_belakang;
        $dosen->save();

        return redirect('/data-dosen')->with('success', 'Data Dosen berhasil ditambah!');
        
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
        $dosens = Dosen::find($id);
        $data['dosen'] = $dosens;
        // $data['action'] = '/data-dosen/update';
        return view('data_dosen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $dosen = Dosen::find($request->id);
        $dosen->nama = $request->nama;
        $dosen->nidn = $request->nidn;
        $dosen->gelar_depan = $request->gelar_depan;
        $dosen->gelar_belakang = $request->gelar_belakang;
        $dosen->save();
        return redirect('/data-dosen')->with('success', 'Data Dosen berhasil diedit!');

        // return redirect()->to('/data-dosen'); 
        // $dosen->update([
            // $dosen->nama = $request->nama,
            // $dosen->nidn = $request->nidn,
            // $dosen->email= $request->email,
            // $dosen->role_id = $request->role_id,
            // $dosen->password = $request->password,
        // ]);
        // $dosen->nama = $request->input('nama');
        // $dosen->nidn = $request->input('nidn');
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
        Dosen::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/data-dosen')->with('hapus', 'Data Dosen berhasil dihapus!');
    }
}
