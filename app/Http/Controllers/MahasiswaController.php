<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Support\Facades\Hash;


class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::orderBy('nim', 'desc')->get();
        $data['mahasiswa'] = $mahasiswas;
        return view('data_mahasiswa.index', $data);
    }
    // public function cetak()
    // {
    // 	$mahasiswa = Mahasiswa::all();
 
    // 	$pdf = PDF::loadview('data_mahasiswa.cetak',['mahasiswa'=>$mahasiswa]);
    //     $pdf->setPaper('A4', 'portrait');
    //     $nama_dokumen = 'data mahasiswa.pdf';
    // 	return $pdf->stream($nama_dokumen);
    // }

    public function import(Request $request)
    {
        try {
            if ($request->hasFile('excel_file')) {
                $file = $request->file('excel_file');
    
                Excel::import(new MahasiswaImport, $file);
    
                return redirect()->back()->with('success', 'Data Mahasiswa berhasil diimport!');
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
        $data['action'] = 'mahasiswa.store';
        return view('data_mahasiswa.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim' => 'required',
            'nama' => 'required|min:3',
            'angkatan' => 'required',
        ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->save();

        return redirect('/data-mahasiswa')->with('success', 'Data Mahasiswa berhasil ditambah!');
        
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
        $mahasiswas = Mahasiswa::find($id);
        $data['mahasiswa'] = $mahasiswas;
        // $data['action'] = '/data-dosen/update';
        return view('data_mahasiswa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->id);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->angkatan = $request->angkatan;
        // if($mahasiswa->password == $request->password){
        //     $mahasiswa->password = $request->password;
        // }else{
        //     $mahasiswa->password = Hash::make($request->password);
        // }
        $mahasiswa->save();
        return redirect('/data-mahasiswa')->with('success', 'Data Mahasiswa berhasil diedit!');

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
        Mahasiswa::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/data-mahasiswa')->with('hapus', 'Data Mahasiswa berhasil dihapus!');
    }


}
