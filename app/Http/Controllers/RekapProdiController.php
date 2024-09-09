<?php

namespace App\Http\Controllers;

use App\Models\Cepeel;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Penilaian;
use App\Models\Peserta;
use Illuminate\Http\Request;


class RekapProdiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;
        if ($request->filled('search') && preg_match('/^[a-zA-Z0-9]+$/', $keyword)) {
        
            $mahasiswa = Mahasiswa::where('angkatan','like','%'.$request->search.'%')
            // ->orwhere('nim','like','%'.$request->search.'%')
            ->get();
            
            $cepeel = Cepeel::count();
            $matkuls = Matkul::all();
            $count_mtkl = count($matkuls);
            $pesertas = Peserta::all();
            $kelass = Kelas::all();
            $penilaians = Penilaian::all();
            
            
            // dd($mahasiswa);
            return view('rekap_prodi.index', compact('keyword','mahasiswa','cepeel','matkuls','penilaians','kelass','pesertas','count_mtkl'));
            
        } else {
            $mahasiswa = Mahasiswa::all();
            $cepeel = Cepeel::count();
            $matkuls = Matkul::all();
            $count_mtkl = count($matkuls);
            $pesertas = Peserta::all();
            $kelass = Kelas::all();
            $penilaians = Penilaian::all();
            
            
            // dd($mahasiswa);
            return view('rekap_prodi.index', compact('keyword','mahasiswa','cepeel','matkuls','penilaians','kelass','pesertas','count_mtkl'));
            
        }
    }
    
    // public function profile()
    // {
    //     return view('profile.index');
    // }


}
