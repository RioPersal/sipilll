<?php

namespace App\Http\Controllers;

use App\Models\Cepeel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CepeelImport;
use Illuminate\Http\Request;


class CPLController extends Controller
{
    public function index()
    {
        $cepeels = Cepeel::all();
        $data['cepeel'] = $cepeels;
        return view('cpl_prodi.index', $data);
    }

    public function import(Request $request)
    {
        try {
            if ($request->hasFile('excel_file')) {
                $file = $request->file('excel_file');
    
                Excel::import(new CepeelImport, $file);
    
                return redirect()->back()->with('success', 'Data CPL berhasil diimport!');
            }
    
            return redirect()->back()->with('error', 'Tidak ada file excel yang diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimport file excel!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['action'] = 'cpl.store';
        return view('cpl_prodi.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_cpl' => 'required',
            'keterangan' => 'required',
            // 'subketerangan1' => 'required',
            // 'subketerangan2' => 'required',
            // 'subketerangan3' => 'required',
        ]);

        $cepeel = new Cepeel;
        $cepeel->kode_cpl = $request->kode_cpl;
        $cepeel->keterangan = $request->keterangan;
        $cepeel->save();

        return redirect('/cpl-prodi')->with('success', 'Data CPL berhasil ditambah!');
        
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
        $cepeels = Cepeel::find($id);
        $data['cepeel'] = $cepeels;
        // $data['action'] = '/data-dosen/update';
        return view('cpl_prodi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $cepeel = Cepeel::find($request->id);
        $cepeel->kode_cpl = $request->kode_cpl;
        $cepeel->keterangan = $request->keterangan;
        $cepeel->save();
        return redirect('/cpl-prodi')->with('success', 'Data CPL berhasil diedit!');

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
        Cepeel::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/cpl-prodi')->with('hapus', 'Data CPL berhasil dihapus!');
    }

}
