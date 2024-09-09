<?php

namespace App\Http\Controllers;

use App\Imports\MatkulIndImport;
use App\Models\Cepeel;
use App\Models\IndikatorCPL;
use App\Models\Matkul;
use App\Models\MatkulInd;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MatkulIndController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matkul = Matkul::all();
        $cepeel = Cepeel::all();
        $indikator = IndikatorCPL::all();
        $matkul_ind = MatkulInd::all();
        // $explodedData1 = array();
        //     foreach ($matkuls as $data) {
        //         $explodedData1[] = explode(",", $data->id_dosen);
        //     }
        // $data['matkul'] = $matkuls;
        return view('matkul_ind.index', compact('matkul','cepeel','indikator','matkul_ind'));
    }

    public function import(Request $request)
    {
        $file = $request->file('excel_file');

        Excel::import(new MatkulIndImport, $file);

        return redirect()->back()->with('success', 'Data Matkul VS Indikator berhasil diimport!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $matkul = Matkul::find($id);
        $cepeel = Cepeel::all();
        $indikator = IndikatorCPL::all();
        // dd($matkul);
        $data['action'] = 'matkulind.store';
        return view('matkul_ind.tambah', $data, compact('matkul','cepeel','indikator'));
    }

    /**
     * Store a newly created resource in storage.
     */

    //  public function store(Request $request)
    //  {
    //     $cepeel = Cepeel::all();
    //     $indikator = IndikatorCPL::all();
    //      $id_matkul = $request->input('id_matkul');
    //      $id_indikator = $request->input('id_indikator');
    //      $bobot_indikator = $request->input('bobot_indikator');
    //     dd($id_matkul);
    //      foreach ($id_matkul as $key => $id) {
    //          foreach ($cepeel as $cpl) {
    //              foreach ($indikator->where('id_cpl', $cpl->id) as $ind) {
    //                  if (isset($id_indikator[$key]) && isset($bobot_indikator[$key])) {
    //                      $data = new MatkulInd();
    //                      $data->id_matkul = $id_matkul[$key];
    //                      $data->id_indikator = $id_indikator[$key][$ind->id];
    //                      $data->bobot_indikator = $bobot_indikator[$key][$ind->id];
    //                      $data->save();
    //                  }
    //              }
    //          }
    //      }
     
    //      return redirect('/pemetaan-matkul-dan-cpmk')->with('success', 'Data Matakuliah VS Indikator berhasil ditambah!');
    //  }
    
    public function store(Request $request)
    {
        foreach ($request->id_indikator as $id_indikator) {
            $matkind = new MatkulInd;
            $matkind->id_matkul = $request->id_matkul;
            $matkind->id_indikator = $id_indikator;
            $matkind->bobot_indikator = $request->bobot_indikator[$id_indikator-1];
            $matkind->save();
        }
        return redirect('/pemetaan-matkul-dan-cpmk')->with('success', 'Data Matakuliah VS Indikator berhasil ditambah!');
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
        $matkul = Matkul::find($id);
        $matkul_ind = MatkulInd::where('id_matkul', $matkul->id)->get();
        $cepeel = Cepeel::all();
        $indikator = IndikatorCPL::all();
        // $data['matkul_ind'] = $matkul_ind;
        // dd($matkul_ind);
        return view('matkul_ind.edit', compact('matkul','matkul_ind','cepeel','indikator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        MatkulInd::where('id_matkul',$request->id_matkul)->delete();
        
        $id_indikator = $request->id_indikator;
        $bobot_indikator = $request->bobot_indikator;
        $count = count($id_indikator);
        for ($i=0; $i < $count; $i++) { 
            $matkind = new MatkulInd;
            $matkind->id_matkul = $request->id_matkul;
            $matkind->id_indikator = $id_indikator[$i];
            $a = $id_indikator[$i]-1;
            $matkind->bobot_indikator = $bobot_indikator[$a];
            $matkind->save();
        }

        

        return redirect('/pemetaan-matkul-dan-cpmk')->with('success', 'Data Matkul VS Indikator berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
