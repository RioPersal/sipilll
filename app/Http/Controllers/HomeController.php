<?php

namespace App\Http\Controllers;
use App\Models\Bukti;
use App\Models\Cepeel;
use App\Models\Dosen;
use App\Models\Employee;
use App\Models\IndikatorCPL;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Nota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $dosen = Dosen::count();
        $mahasiswa = Mahasiswa::count();
        $mahasiswa_lama = Mahasiswa::orderBy('nim', 'asc')->pluck('angkatan')->first();
        $mahasiswa_baru = Mahasiswa::orderBy('nim', 'desc')->pluck('angkatan')->first();
        // dd($mahasiswa_baru);
        $matkul = Matkul::count();
        $cpl = Cepeel::all();
        $count_cpl = count($cpl);
        // dd($count_cpl);
        $indikator_cpl = IndikatorCPL::all();
        return view('home.index', compact('dosen','mahasiswa','mahasiswa_lama','mahasiswa_baru','matkul','cpl','count_cpl','indikator_cpl'));
    }
    
    // public function profile()
    // {
    //     return view('profile.index');
    // }


}
