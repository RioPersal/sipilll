<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Pengampu;
use App\Models\Peserta;
use App\Models\Tahunakademik;
use Illuminate\Http\Request;


class KelasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('akademik') && $request->akademik != '') {
            $akademik = Tahunakademik::orderBy('id', 'desc')->get();
            $tahunakademiks = Tahunakademik::where('id', $request->akademik)->first();
            $kelas = Kelas::where('id_tahunakademik', $tahunakademiks->id)->get();
            $matkuls = Matkul::all();
            $dosens = Dosen::all();
            $pengampu = Pengampu::all();
            return view('data_kelas.index', compact('tahunakademiks','akademik','kelas','matkuls','dosens','pengampu'));
        } else{
            $akademik = Tahunakademik::orderBy('id', 'desc')->get();
            $tahunakademiks = Tahunakademik::latest('created_at')->first();
            $kelas = Kelas::where('id_tahunakademik', $tahunakademiks->id)->get();
            // dd($kelas);
            $matkuls = Matkul::all();
            $dosens = Dosen::all();
            $pengampu = Pengampu::all();
            return view('data_kelas.index', compact('tahunakademiks','akademik','kelas','matkuls','dosens','pengampu'));
        }        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $tahunakademiks = Tahunakademik::find($id);
        $matkuls = Matkul::all();
        $data['action'] = 'kelas.store';
        return view('data_kelas.tambah', $data, compact('matkuls','tahunakademiks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_matkul' => 'required',
            'nama_kelas' => 'required',
        ]);

        $kelas = new Kelas;
        $kelas->id_matkul = $request->id_matkul;
        $kelas->id_tahunakademik = $request->id_tahunakademik;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->save();

        return redirect('/data-kelas')->with('success', 'Data Kelas berhasil ditambah!');
        
    }


    public function edit(string $id)
    {
        $kelass = Kelas::find($id);
        $tahunakademiks = Tahunakademik::where('id',$kelass->id_tahunakademik)->first();
        $matkuls = Matkul::all();
        $data['kelas'] = $kelass;
        $dosens = Dosen::all();
        // $data['action'] = '/data-dosen/update';
        return view('data_kelas.edit', $data, compact('matkuls','tahunakademiks','dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $kelas = Kelas::find($request->id);
        $kelas->id_tahunakademik = $request->id_tahunakademik;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->id_matkul = $request->id_matkul;
        $kelas->save();
        return redirect('/data-kelas')->with('success', 'Data Kelas berhasil diedit!');

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

    public function peserta_index(string $id)
    {
        $kelas = Kelas::find($id);
        $matkul = Matkul::where('id',$kelas->id_matkul)->first();
        // dd($matkul);
        $peserta = Peserta::where('id_kelas',$kelas->id)->get();
        $mahasiswa = Mahasiswa::all();
        // $explodedData1 = array();
        //     foreach ($matkuls as $data) {
        //         $explodedData1[] = explode(",", $data->id_dosen);
        //     }
        // $dosens = Dosen::all();
        $tahunakademiks = Tahunakademik::all();
        return view('data_peserta.index', compact('peserta','matkul','kelas','tahunakademiks','mahasiswa'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kelas::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/data-kelas')->with('hapus', 'Data Kelas berhasil dihapus!');
    }


}
