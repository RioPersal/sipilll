<?php

namespace App\Http\Controllers;

use App\Models\Tahunakademik;
use Illuminate\Http\Request;


class TahunAkademikController extends Controller
{
    public function index()
    {
        $tahunakademiks = Tahunakademik::all();
        $data['tahunakademik'] = $tahunakademiks;
        return view('data_tahunakademik.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['action'] = 'tahunakademik.store';
        return view('data_tahunakademik.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_semester' => 'required',
        ]);

        $tahunakademik = new Tahunakademik;
        $tahunakademik->nama_semester = $request->nama_semester;
        $data = [$request->tahun_akademik1, $request->tahun_akademik2];
        $thn = implode("/", $data);
        $tahunakademik->tahun_akademik = $thn;
        $tahunakademik->save();
        return redirect('/data-kelas')->with('success', 'Data Tahun Akademik berhasil ditambah!');
        
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
        $tahunakademiks = Tahunakademik::find($id);
        $tahun = explode('/', $tahunakademiks->tahun_akademik);
        $data['tahunakademik'] = $tahunakademiks;
        // $data['action'] = '/data-dosen/update';
        return view('data_tahunakademik.edit', $data, compact('tahun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $tahunakademik = Tahunakademik::find($request->id);
        $tahunakademik->nama_semester = $request->nama_semester;
        $data = [$request->tahun_akademik1, $request->tahun_akademik2];
        $thn = implode("/", $data);
        $tahunakademik->tahun_akademik = $thn;
        $tahunakademik->save();
        return redirect('/data-kelas')->with('success', 'Data Tahun Akademik berhasil diedit!');

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
        Tahunakademik::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/data-kelas')->with('hapus', 'Data Tahun Akademik berhasil dihapus!');
    }

}
