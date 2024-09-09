<?php

namespace App\Http\Controllers;

use App\Models\Cepeel;
use App\Models\IndikatorCPL;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IndikatorCPLImport;
use Illuminate\Http\Request;


class IndikatorController extends Controller
{
    public function index()
    {
        $indikators = IndikatorCPL::all();
        $cepeels = Cepeel::all();
        $data['indikator'] = $indikators;
        return view('indikator_cpl.index', $data, compact('cepeels'));
    }

    public function import(Request $request)
    {
        $file = $request->file('excel_file');

        Excel::import(new IndikatorCPLImport, $file);

        return redirect()->back()->with('success', 'Data Indikator LO berhasil diimport!');
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
    public function create(string $id)
    {
        $cepeels = Cepeel::find($id);
        // dd($cepeels);
        $data['action'] = 'indikator.store';
        return view('indikator_cpl.tambah', $data, compact('cepeels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'indikator' => 'required',
            'ket_indikator' => 'required',
        ]);

        $indikator = new IndikatorCPL();
        $indikator->id_cpl = $request->id_cpl;
        $indikator->indikator = $request->indikator;
        $indikator->ket_indikator = $request->ket_indikator;
        $indikator->save();

        return redirect('/cpmk')->with('success', 'Data Indikator LO berhasil ditambah!');
        
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
        $indikator = IndikatorCPL::find($id);
        $cepeel = Cepeel::where('id', $indikator->id_cpl)->first();
        $data['indikator'] = $indikator;
        // $data['action'] = '/data-dosen/update';
        return view('indikator_cpl.edit', $data, compact('cepeel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $indikator = IndikatorCPL::find($request->id);
        $indikator->id_cpl = $request->id_cpl;
        $indikator->indikator = $request->indikator;
        $indikator->ket_indikator = $request->ket_indikator;
        $indikator->save();
        return redirect('/cpmk')->with('success', 'Data Indikator LO berhasil diedit!');

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
        IndikatorCPL::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/cpmk')->with('hapus', 'Data CPL berhasil dihapus!');
    }

}
