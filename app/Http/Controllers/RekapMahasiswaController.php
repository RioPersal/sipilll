<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Cepeel;
use App\Models\Cpmk;
use App\Models\IndikatorCPL;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\MatkulInd;
use App\Models\Penilaian;
use App\Models\Persentase;
use App\Models\Peserta;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;


class RekapMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;
        if ($request->filled('search') && preg_match('/^[a-zA-Z0-9]+$/', $keyword)) {
        
            $mahasiswa = Mahasiswa::where('nama','like','%'.$request->search.'%')
            ->orwhere('nim','like','%'.$request->search.'%')
            ->first();
            $matkuls = Matkul::all()->sortBy('semester');
            $mtkl = Matkul::all();
            $kelass = Kelas::all();
            $peserta = Peserta::all();
            $cepeel = Cepeel::all();
            $indikator = IndikatorCPL::all();
            $cpmk = Cpmk::all();
            $bobot_cpmk = Bobot::all();
            $penilaian = Penilaian::all();
            $mat_ind = MatkulInd::all();
            $mtnd = MatkulInd::all();

            // dd($kelass);
            $cepeel_count = Cepeel::count();
            


            return view('rekap_mahasiswa.index', compact('mahasiswa','cepeel','cepeel_count','indikator','cpmk','mat_ind','bobot_cpmk','matkuls','mtkl','mtnd','penilaian','kelass','peserta'));
            
        } else {
            $mahasiswa = null;
            return view('rekap_mahasiswa.index', compact('mahasiswa'));
        }
        
        
    }
    
    public function cetak(string $id)
    {
    	$mahasiswa = Mahasiswa::find($id);
        // dd($mahasiswa);
        $matkuls = Matkul::all()->sortBy('semester');
        $mtkl = Matkul::all();
        $kelass = Kelas::all();
        $peserta = Peserta::all();
        $cepeel = Cepeel::all();
        $indikator = IndikatorCPL::all();
        $cpmk = Cpmk::all();
        $bobot_cpmk = Bobot::all();
        $penilaian = Penilaian::all();
        $mat_ind = MatkulInd::all();
        $mtnd = MatkulInd::all();
        $cepeel_count = Cepeel::count();
 
    	$pdf = PDF::loadview('rekap_mahasiswa.cetak', compact('mahasiswa','cepeel','cepeel_count','indikator','cpmk','mat_ind','bobot_cpmk','matkuls','mtkl','mtnd','penilaian','kelass','peserta'));
        $pdf->setPaper('A4', 'portrait');
        $nama_dokumen = 'Transkrip CPL.pdf';
    	return $pdf->stream($nama_dokumen);
    }
    // public function profile()
    // {
    //     return view('profile.index');
    // }


}
