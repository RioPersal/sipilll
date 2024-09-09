<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Cepeel;
use App\Models\Cpmk;
use App\Models\Dosen;
use App\Models\IndikatorCPL;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use App\Models\MatkulInd;
use App\Models\Pengampu;
use App\Models\Semester;
use App\Models\Peserta;
use App\Models\Penilaian;
use App\Models\Persentase;
use App\Models\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('akademik') && $request->akademik != '') {
            $tahunakademiks = Tahunakademik::where('id',$request->akademik)->first();
            $akademik = Tahunakademik::orderBy('id', 'desc')->get();
            $user = Auth::user();
            $dosen = Dosen::where('nama', $user->name)->first();
            $pengampu = Pengampu::all();
            $id_matkul = [];
            foreach ($pengampu as $value) {
                $value_pengampu = explode(',', $value->id_pengampu);
                if (in_array($dosen->id, $value_pengampu)) {
                    $id_matkul[] = $value->id_matkul;
                }
            }
            $matkul = Matkul::whereIn('id', $id_matkul)->get();

            $id = [];
            foreach ($matkul as $mtkl) {
                $id[] = $mtkl->id;
            }

            $kelas = Kelas::whereIn('id_matkul', $id)->get();
            // dd($kelass);

            return view('data_penilaian.index', compact('kelas','dosen','matkul','tahunakademiks','akademik'));
        } else{
            $tahunakademiks = Tahunakademik::latest('created_at')->first();
            $akademik = Tahunakademik::orderBy('id', 'desc')->get();
            $user = Auth::user();
            $dosen = Dosen::where('nama', $user->name)->first();
            $pengampu = Pengampu::all();
            $id_matkul = [];
            foreach ($pengampu as $value) {
                $value_pengampu = explode(',', $value->id_pengampu);
                if (in_array($dosen->id, $value_pengampu)) {
                    $id_matkul[] = $value->id_matkul;
                }
            }
            $matkul = Matkul::whereIn('id', $id_matkul)->get();

            $id = [];
            foreach ($matkul as $mtkl) {
                $id[] = $mtkl->id;
            }

            $kelas = Kelas::whereIn('id_matkul', $id)->get();
            // dd($kelass);

            return view('data_penilaian.index', compact('kelas','dosen','matkul','tahunakademiks','akademik'));
        }
    }

    public function detail(string $id)
    {
        $kelas = Kelas::find($id);
        $matkul = Matkul::where('id',$kelas->id_matkul)->first();
        $matkul_ind = MatkulInd::where('id_matkul',$matkul->id)->get();
        
        $id_indikator = [];
        foreach ($matkul_ind as $value) {
            $id_indikator[] = $value->id_indikator;
        }

        $id_matdin = [];
        foreach ($matkul_ind->whereIn('id_indikator',$id_indikator) as $value) {
            $id_matdin[] = $value->id;
        }

        $indikator = IndikatorCPL::whereIn('id',$id_indikator)->get();
// dd($indikator);        
        $id_cpl = [];
        foreach ($indikator as $item) {
            $id_cpl[] = $item->id_cpl;
        }

        $cepeel = Cepeel::whereIn('id', $id_cpl)->get();
        $tahunakademik = Tahunakademik::all();
        $cpmk = Cpmk::all();
        $bobot_cpmk = Bobot::all();
        $peserta = Peserta::all();
        $mahasiswa = Mahasiswa::all();
        $penilaian = Penilaian::all();
        $mat_ind = MatkulInd::whereIn('id',$id_matdin)->get();
        // dd($indikator);
        
        return view('data_penilaian.detail', compact('cepeel','matkul','mat_ind','id_matdin','cpmk','kelas','tahunakademik','indikator','bobot_cpmk','peserta','mahasiswa','penilaian'));

        // $penilaians = Penilaian::all();
        // $cepeels = Cepeel::all();
        // $kelass = Kelas::find($id);
        // $persentase = Persentase::where('id_kelas', $kelass->id)->first();
        // $matkuls = Matkul::where('id', $kelass->id_matkul)->first();
        // $value_cpl = explode(',', $matkuls->id_cpl);
        // $jumlah_cpl = count($value_cpl);
        // $peserta = Peserta::all();
        // $mahasiswa = Mahasiswa::all();
        // $tahunakademiks = Tahunakademik::all();
        // $data['penilaian'] = $penilaians;
        // return view('data_penilaian.detail', $data, compact('penilaians','persentase','kelass','matkuls','tahunakademiks','value_cpl','peserta','mahasiswa','jumlah_cpl','cepeels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id1, $id2)
    {
        $kelas = Kelas::find($id1);
        $matkul = Matkul::where('id', $kelas->id_matkul)->first();
        $matkul_ind = MatkulInd::where('id_matkul',$matkul->id)->get();

        $id_indikator = [];
        foreach ($matkul_ind as $value) {
            $id_indikator[] = $value->id_indikator;
        }
        $indikator = IndikatorCPL::whereIn('id',$id_indikator)->get();
        $id_cpl = [];
        foreach ($indikator as $item) {
            $id_cpl[] = $item->id_cpl;
        }
        $cepeel = Cepeel::whereIn('id',$id_cpl)->get();
        $cpmk = Cpmk::all();
        $bobot_cpmk = Bobot::all();
        $peserta = Peserta::find($id2);
        $value_cpl = explode(',', $matkul->id_cpl);
        $mahasiswa = Mahasiswa::where('id',$peserta->id_mahasiswa)->first();
        // dd($mahasiswa);
        $tahunakademik = Tahunakademik::all();
        $data['action'] = 'penilaian.store';
        return view('data_penilaian.tambah', $data, compact('kelas','matkul','peserta','mahasiswa','tahunakademik','value_cpl','cepeel','indikator','cpmk','bobot_cpmk','id_indikator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kelas = Kelas::find($request->id_kelas);
        // $matkul = Matkul::where('id', $kelas->id_matkul)->first();
        $mahasiswa = Mahasiswa::find($request->id_mahasiswa);
        $pilihan = $request->id_asesmen;
        $nilai = $request->nilai;
        $count = count($pilihan);
        // dd($kelas);

        for ($i=0; $i <$count ; $i++) {
            $penilaian = new Penilaian;
            $penilaian->id_mahasiswa = $mahasiswa->id;
            $penilaian->id_kelas = $kelas->id;
            $penilaian->id_asesmen = $pilihan[$i];
            $penilaian->nilai = $nilai[$i];
            $penilaian->save();
        }
        // $validateData = $request->validate([
        //     'nilai[ ]' => 'required',
        // ]);

        // $kelas = Kelas::find($request->id_kelas);
        // $matkul = Matkul::where('id', $kelas->id_matkul)->first();
        // $value_cpl = explode(',', $matkul->id_cpl);
        // $penilaian = new Penilaian;
        // $penilaian->id_kelas = $request->id_kelas;
        // $penilaian->id_peserta = $request->id_peserta;

        // foreach ($value_cpl as $v) {
        // $data = [$request->{"nilai{$v}1"}, $request->{"nilai{$v}2"}, $request->{"nilai{$v}3"}];
        // $no = implode(",", $data) ;
        // $penilaian->{"nilai_cpl{$v}"} = $no;
        // }        
        // $penilaian->save();

        return redirect('/data-penilaian/'.$kelas->id)->with('success', 'Data Penilaian berhasil ditambah!');
        
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
    public function edit(string $id1, $id2)
    {
        $kelas = Kelas::find($id1);
        $matkul = Matkul::where('id', $kelas->id_matkul)->first();
        $matkul_ind = MatkulInd::where('id_matkul',$matkul->id)->get();

        $id_indikator = [];
        foreach ($matkul_ind as $value) {
            $id_indikator[] = $value->id_indikator;
        }
        $indikator = IndikatorCPL::whereIn('id',$id_indikator)->get();
        $id_cpl = [];
        foreach ($indikator as $item) {
            $id_cpl[] = $item->id_cpl;
        }
        $cepeel = Cepeel::whereIn('id',$id_cpl)->get();
        $cpmk = Cpmk::all();
        $bobot_cpmk = Bobot::all();
        $peserta = Peserta::find($id2);
        $value_cpl = explode(',', $matkul->id_cpl);
        $mahasiswa = Mahasiswa::where('id',$peserta->id_mahasiswa)->first();
        $tahunakademik = Tahunakademik::all();
        $penilaian = Penilaian::where('id_mahasiswa',$peserta->id_mahasiswa)->where('id_kelas',$kelas->id)->get();
        // dd($penilaian);
        $data['action'] = 'penilaian.store';
        // dd($value_cpl);
        return view('data_penilaian.edit', $data, compact('kelas','matkul','peserta','mahasiswa','tahunakademik','value_cpl','cepeel','indikator','cpmk','bobot_cpmk','penilaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // $validateData = $request->validate([
        //     'nilai' => 'numeric',
        // ]);
        $kelas = Kelas::find($request->id_kelas);
        // $matkul = Matkul::where('id', $kelas->id_matkul)->first();
        $mahasiswa = Mahasiswa::find($request->id_mahasiswa);
        $id_penilaian = $request->id;
        $count = count($id_penilaian);
        $pilihan = $request->id_asesmen;
        $nilai = $request->nilai;
        
        // dd($penilaian);
        for ($i=0; $i <$count ; $i++) {
            $penilaian = Penilaian::find($id_penilaian[$i]);
            $penilaian->id_mahasiswa = $mahasiswa->id;
            $penilaian->id_kelas = $kelas->id;
            $penilaian->id_asesmen = $pilihan[$i];
            $penilaian->nilai = $nilai[$i];
            $penilaian->save();
        }
        return redirect('/data-penilaian/'.$kelas->id)->with('success', 'Data Penilaian berhasil diedit!');

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
        return redirect('/data-peserta-kelas')->with('hapus', 'Data Peserta Kelas berhasil dihapus!');
    }


}
