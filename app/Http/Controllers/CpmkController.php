<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\Cepeel;
use App\Models\Cpmk;
use App\Models\IndikatorCPL;
use App\Models\MatkulInd;
use App\Models\Pengampu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CpmkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = Dosen::where('nama', $user->name)->first();
        $pengampu = Pengampu::all();
        $hasil = [];
        foreach ($pengampu as $value) {
            $value_pengampu = explode(',', $value->id_pengampu);
            if (in_array($dosen->id, $value_pengampu)) {
                $hasil[] = $value->id_matkul;
            }
        }

        $matkul = Matkul::whereIn('id', $hasil)->get();
        // $data['matkul'] = $matkuls;
        return view('cpmk.index', compact('matkul'));
    }

    public function detail(string $id)
    {
        
        $matkul = Matkul::find($id);
        // dd($matkul);
        $matkul_ind = MatkulInd::where('id_matkul',$matkul->id)->get();

        // $id_matdin = [];
        $id_indikator = [];
        foreach ($matkul_ind as $value) {
            // $id_matdin[] = $value->id;
            $id_indikator[] = $value->id_indikator;
        }
        $indikator = IndikatorCPL::whereIn('id',$id_indikator)->get();
        $id_cpl = [];
        foreach ($indikator as $item) {
            $id_cpl[] = $item->id_cpl;
        }

        $cpmk = Cpmk::all();
        $bobot_cpmk = Bobot::all();
        $cepeel = Cepeel::whereIn('id', $id_cpl)->get();
        // dd($bobot_cpmk);
        // $indikator = IndikatorCPL::all();
        return view('cpmk.detail', compact('id_indikator','cpmk','bobot_cpmk','matkul','matkul_ind','cepeel','indikator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id1, $id2)
    {
        $matkul = Matkul::find($id1);
        $indikator = IndikatorCPL::find($id2);
        $cepeel = Cepeel::where('id',$indikator->id_cpl)->get();
        $matkul_ind = MatkulInd::where('id_indikator',$indikator->id)->first();
        // dd($indikator);
        $data['action'] = 'cpmk.store';
        return view('cpmk.tambah', $data, compact('matkul','matkul_ind','cepeel','indikator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $indikator = IndikatorCPL::find($request->id_indikator);
        // $matkul_ind = MatkulInd::where('id_indikator',$indikator->id)->first();
        $matkul = Matkul::find($request->id_matkul);

        $request->validate([
            'kode_cpmk' => 'required',
            'ket_cpmk' => 'required',
        ]);

        $cpmk = new Cpmk;
        $cpmk->id_matkul = $request->id_matkul;
        $cpmk->id_indikator = $request->id_indikator;
        $cpmk->kode_cpmk = $request->kode_cpmk;
        $cpmk->ket_cpmk = $request->ket_cpmk;
        $cpmk->save();

        return redirect('/sub-cpmk/'.$matkul->id)->with('success', 'Data CPMK berhasil ditambah!');
        
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
        $matkul = Matkul::find($id1);
        $cpmk = Cpmk::find($id2);
        $indikator = IndikatorCPL::find($cpmk->id_indikator);
        $cepeel = Cepeel::find($indikator->id_cpl);
        $matkul_ind = MatkulInd::where('id_indikator',$indikator->id)->first();
        // $data['action'] = '/data-dosen/update';
        return view('cpmk.edit', compact('matkul_ind','matkul','indikator','cepeel','cpmk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // $matkul_ind = MatkulInd::find($request->id_matdin);
        $matkul = Matkul::find($request->id_matkul);

        $request->validate([
            'kode_cpmk' => 'required',
            'ket_cpmk' => 'required',
        ]);

        $cpmk = Cpmk::find($request->id);
        $cpmk->id_matkul = $request->id_matkul;
        $cpmk->kode_cpmk = $request->kode_cpmk;
        $cpmk->ket_cpmk = $request->ket_cpmk;
        $cpmk->save();
        return redirect('/sub-cpmk/'.$matkul->id)->with('success', 'Data CPMK berhasil diedit!');
    }

    public function create_bobot(string $id1,$id2)
    {
        $matkul = Matkul::find($id1);
        $cpmk = Cpmk::find($id2);
        $indikator = IndikatorCPL::where('id',$cpmk->id_indikator)->first();
        $matkul_ind = MatkulInd::where('id_indikator',$indikator->id)->first();
        $cepeel = Cepeel::where('id',$indikator->id_cpl)->get();
        // dd($cepeel);
        $data['action'] = 'cpmk.store_bobot';
        return view('cpmk.tambah_bobot', $data, compact('cpmk','matkul','matkul_ind','cepeel','indikator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_bobot(Request $request)
    {
        $request->validate([
            'indikator_asesmen' => 'required',
            'pilihan_asesmen' => 'required',
            'bobot_cpmk' => 'required',
        ]);

        $indikator = $request->indikator_asesmen;
        $pilihan = $request->pilihan_asesmen;
        $count = count($pilihan);
        $bobot_cpmk = $request->bobot_cpmk;
        // dd($bobot_cpmk);

        for ($i=0; $i <$count ; $i++) {
            $bobot = new Bobot;
            $bobot->id_cpmk = $request->id_cpmk;
            $bobot->indikator_asesmen = $indikator[$i];
            $bobot->pilihan_asesmen = $pilihan[$i];
            $bobot->bobot_cpmk = $bobot_cpmk[$i];
            $bobot->save();
        }

        return redirect('/sub-cpmk/'.$request->id_matkul)->with('success', 'Data bobot CPMK berhasil ditambah!');
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit_bobot(string $id1,$id2)
    {
        $matkul = Matkul::find($id1);
        $cpmk = Cpmk::find($id2);
        $bobot_cpmk = Bobot::where('id_cpmk',$cpmk->id)->get();
        // dd($bobot_cpmk);
        $indikator = IndikatorCPL::where('id',$cpmk->id_indikator)->first();
        $matkul_ind = MatkulInd::where('id_indikator',$indikator->id)->first();
        $cepeel = Cepeel::where('id',$indikator->id_cpl)->get();
        return view('cpmk.edit_bobot', compact('cpmk','bobot_cpmk','matkul','matkul_ind','cepeel','indikator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_bobot(Request $request)
    {
        $request->validate([
            'indikator_asesmen' => 'required',
            'pilihan_asesmen' => 'required',
            'bobot_cpmk' => 'required',
        ]);

        Bobot::where('id_cpmk', $request->id_cpmk)->delete();

        $indikator = $request->indikator_asesmen;
        $pilihan = $request->pilihan_asesmen;
        $count = count($pilihan);
        $bobot_cpmk = $request->bobot_cpmk;
        // dd($bobot_cpmk);
        for ($i=0; $i <$count ; $i++) {
            $bobot = new Bobot;
            $bobot->id_cpmk = $request->id_cpmk;
            $bobot->indikator_asesmen = $indikator[$i];
            $bobot->pilihan_asesmen = $pilihan[$i];
            $bobot->bobot_cpmk = $bobot_cpmk[$i];
            $bobot->save();
        }

        return redirect('/sub-cpmk/'.$request->id_matkul)->with('success', 'Data bobot CPMK berhasil diedit!');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id1,$id2)
    {
        $matkul = Matkul::find($id1);
        $cpmk = Cpmk::find($id2);
        // $indikator = IndikatorCPL::where('id',$cpmk->id_indikator)->first();
        // $matkul_ind = MatkulInd::where('id_indikator',$indikator->id)->first();

        Bobot::where('id_cpmk', $cpmk->id)->delete();
        Cpmk::where('id',$id2)->delete();
        // dd($cpmk);
        // Matkul::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/sub-cpmk/'.$matkul->id)->with('hapus', 'Data CPMK beserta Bobotnya berhasil dihapus!');
    }

}
