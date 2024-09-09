<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MatkulImport;
use App\Models\Dosen;
use App\Models\Pengampu;
use Illuminate\Http\Request;


class MatkulController extends Controller
{
    public function index()
    {
        $matkuls = Matkul::all();
        $pengampu = Pengampu::all();
        // $explodedData1 = array();
        //     foreach ($matkuls as $data) {
        //         $explodedData1[] = explode(",", $data->id_dosen);
        //     }
        $data['matkul'] = $matkuls;
        return view('data_matkul.index', $data, compact('pengampu'));
    }

    public function import(Request $request)
    {
        $file = $request->file('excel_file');
    
                Excel::import(new MatkulImport, $file);
    
                return redirect()->back()->with('success', 'Data Mata Kuliah berhasil diimport!');
        // try {
        //     if ($request->hasFile('excel_file')) {
        //         $file = $request->file('excel_file');
    
        //         Excel::import(new MatkulImport, $file);
    
        //         return redirect()->back()->with('success', 'Data Mata Kuliah berhasil diimport!');
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
        $data['action'] = 'matkul.store';
        return view('data_matkul.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_matkul' => 'required',
            'nama_matkul' => 'required',
            // 'id_cpl' => 'required',
            'sks' => 'required',
        ]);

        $matkul = new Matkul;
        $matkul->kode_matkul = $request->kode_matkul;
        $matkul->nama_matkul = $request->nama_matkul;
        $matkul->semester = $request->semester;
        $matkul->sks = $request->sks;
        $matkul->save();

        return redirect('/data-mata-kuliah')->with('success', 'Data Mata Kuliah berhasil ditambah!');
        
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
        $matkuls = Matkul::find($id);
        $data['matkul'] = $matkuls;
        // $data['action'] = '/data-dosen/update';
        return view('data_matkul.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $matkul = Matkul::find($request->id);
        $matkul->kode_matkul = $request->kode_matkul;
        $matkul->nama_matkul = $request->nama_matkul;
        $matkul->semester = $request->semester;
        $matkul->sks = $request->sks;
        $matkul->save();
        return redirect('/data-mata-kuliah')->with('success', 'Data Mata Kuliah berhasil diedit!');

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

    public function create_pengampu(string $id)
    {
        $matkul = Matkul::find($id);
        $dosen = Dosen::all();
        // dd($cepeel);
        $data['action'] = 'matkul.store_pengampu';
        return view('data_matkul.tambah_pengampu', $data, compact('matkul','dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_pengampu(Request $request)
    {
        $pengampu = new Pengampu;
        $pengampu->id_matkul = $request->id_matkul;
        $id_dosen = implode(',', $request->id_pengampu);
        $pengampu->id_pengampu = $id_dosen;
        $pengampu->id_koordinator = $request->id_koordinator;
        
        $pengampu->save();

        return redirect('/data-mata-kuliah')->with('success', 'Data Koordinator dan Pengampu berhasil ditambah!');
        
    }

    public function edit_pengampu(string $id)
    {
        $matkul = Matkul::find($id);
        $pengampu = Pengampu::where('id_matkul',$matkul->id)->first();
        // dd($pengampu);
        $dosen = Dosen::all();
        $value_pengampu = explode(',', $pengampu->id_pengampu);
        $count = count($value_pengampu);
        // dd($value_pengampu);
        return view('data_matkul.edit_pengampu', compact('matkul','pengampu','dosen','value_pengampu','count'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_pengampu(Request $request)
    {

        $pengampu = Pengampu::find($request->id);
        $pengampu->id_matkul = $request->id_matkul;
        $id_dosen = implode(',', $request->id_pengampu);
        $pengampu->id_pengampu = $id_dosen;
        $pengampu->id_koordinator = $request->id_koordinator;
        
        $pengampu->save();

        return redirect('/data-mata-kuliah')->with('success', 'Data Koordinator dan Pengampu berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Matkul::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/data-mata-kuliah')->with('hapus', 'Data Mata Kuliah berhasil dihapus!');
    }


}
