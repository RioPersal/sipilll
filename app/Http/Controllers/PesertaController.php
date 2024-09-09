<?php

namespace App\Http\Controllers;

use App\Imports\PesertaImport;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Peserta;
use App\Models\Tahunakademik;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PesertaController extends Controller
{
    public function index(string $id)
    {
        $kelas = Kelas::find($id);
        $matkul = Matkul::where('id',$kelas->id_kelas)->first();
        $pesertas = Peserta::all();
        $dosens = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        // $explodedData1 = array();
        //     foreach ($matkuls as $data) {
        //         $explodedData1[] = explode(",", $data->id_dosen);
        //     }
        // $dosens = Dosen::all();
        $tahunakademiks = Tahunakademik::all();
        $data['peserta'] = $pesertas;
        return view('data_peserta.index', $data, compact('dosens','matkul','kelas','tahunakademiks','mahasiswa'));
    }

    public function import(Request $request)
    {
        $file = $request->file('excel_file');

        Excel::import(new PesertaImport, $file);

        return redirect()->back()->with('success', 'Data Peserta Kelas berhasil diimport!');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $kelas = Kelas::find($id);
        $matkuls = Matkul::all();
        $mahasiswa = Mahasiswa::orderBy('nim', 'desc')->get();
        $tahunakademiks = Tahunakademik::all();
        $data['action'] = 'peserta.store';
        return view('data_peserta.tambah', $data, compact('matkuls','kelas','mahasiswa','tahunakademiks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_mahasiswa' => 'required',
        ]);

        $pilihan = $request->id_mahasiswa;
        $count = count($pilihan);

        for ($i=0; $i <$count ; $i++) {
            $peserta = new Peserta;
            $peserta->id_kelas = $request->id_kelas;
            $peserta->id_mahasiswa = $request->id_mahasiswa[$i];
            $peserta->save();
        }

        // $peserta = new Peserta;
        // $peserta->id_kelas = $request->id_kelas;
        // $peserta->id_mahasiswa = $request->id_mahasiswa;
        // $peserta->save();

        return redirect('/data-peserta-kelas/'.$request->id_kelas)->with('success', 'Data Peserta Kelas berhasil ditambah!');
        
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
        $pesertas = Peserta::find($id);
        $kelass = Kelas::all();
        $matkuls = Matkul::all();
        $mahasiswa = Mahasiswa::all();
        $tahunakademiks = Tahunakademik::all();
        $data['peserta'] = $pesertas;
        // $cepeels = Cepeel::all();
        // $dosens = Dosen::all();
        // $semesters = Semester::all();
        // $data['action'] = '/data-dosen/update';
        return view('data_peserta.edit', $data, compact('matkuls','kelass','mahasiswa','tahunakademiks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $peserta = Peserta::find($request->id);
        $peserta->id_kelas = $request->id_kelas;
        $peserta->id_mahasiswa = $request->id_mahasiswa;
        $peserta->save();
        return redirect('/data-peserta-kelas/'.$request->id_kelas)->with('success', 'Data Peserta Kelas berhasil diedit!');

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
        Peserta::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect()->back()->with('hapus', 'Data Peserta Kelas berhasil dihapus!');
    }


}
