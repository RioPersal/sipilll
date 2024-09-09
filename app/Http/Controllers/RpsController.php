<?php

namespace App\Http\Controllers;

use App\Models\Bkajian;
use App\Models\Bobot;
use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\Cepeel;
use App\Models\Cpmk;
use App\Models\Deskripsi;
use App\Models\IndikatorCPL;
use App\Models\InfoRPS;
use App\Models\Kaprodi;
use App\Models\MatkulInd;
use App\Models\Pengampu;
use App\Models\RincianRPS;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;

class RpsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user == 'dosen') {
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
            return view('rps.index', compact('matkul'));
        } else {
            $matkul = Matkul::all();
            return view('rps.index', compact('matkul'));
        }
        
        
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
        
        $pengampu = Pengampu::where('id_matkul',$matkul->id)->first();
        $id_dsn = explode(',', $pengampu->id_pengampu);
        $dsn_pengampu = Dosen::whereIn('id',$id_dsn)->get();
        $dsn_koordinator = Dosen::where('id',$pengampu->id_koordinator)->first();
        $info = InfoRPS::where('id_matkul',$matkul->id)->first();
        $rincian = RincianRPS::where('id_matkul',$matkul->id)->get();
        $dosen = Dosen::all();
        $waktu_terbaru = RincianRPS::orderBy('created_at', 'desc')->first();
        // $id_fasilitator = explode(',', $rincian->fasilitator);
        // $fasilitator = Dosen::whereIn('id',$id_fasilitator)->get();
        // dd($fasilitator);
        // $indikator = IndikatorCPL::all();
        return view('rps.detail', compact('id_indikator','cpmk','bobot_cpmk','matkul','matkul_ind','cepeel','indikator','dsn_pengampu','dsn_koordinator','info','rincian','dosen','waktu_terbaru'));
    }

    public function cetak(string $id)
    {
        $matkul = Matkul::find($id);
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
        
        $pengampu = Pengampu::where('id_matkul',$matkul->id)->first();
        $id_dsn = explode(',', $pengampu->id_pengampu);
        $dsn_pengampu = Dosen::whereIn('id',$id_dsn)->get();
        $dsn_koordinator = Dosen::where('id',$pengampu->id_koordinator)->first();
        $info = InfoRPS::where('id_matkul',$matkul->id)->first();
        $rincian = RincianRPS::where('id_matkul',$matkul->id)->get();
        $kaprodi = Kaprodi::first();
        $dosen = Dosen::all();
        // dd($kaprodi);
        $waktu_terbaru = RincianRPS::orderBy('created_at', 'desc')->first();
 
    	// Buat PDF potret
        $portraitContent = view('rps.cetak1', compact('id_indikator','cpmk','bobot_cpmk','matkul','matkul_ind','cepeel','indikator','dsn_pengampu','dsn_koordinator','info','rincian','waktu_terbaru','kaprodi','dosen'))->render();
        $portraitPdf = PDF::loadHTML($portraitContent)->setPaper('A4', 'portrait');
        $portraitPath = storage_path('app/public/portrait.pdf');
        $portraitPdf->save($portraitPath);

        // Buat PDF lanskap
        $landscapeContent = view('rps.cetak2', compact('id_indikator','cpmk','bobot_cpmk','matkul','matkul_ind','cepeel','indikator','dsn_pengampu','dsn_koordinator','info','rincian','waktu_terbaru','kaprodi','dosen'))->render();
        $landscapePdf = PDF::loadHTML($landscapeContent)->setPaper('A4', 'landscape');
        $landscapePath = storage_path('app/public/landscape.pdf');
        $landscapePdf->save($landscapePath);

        // Gabungkan kedua PDF
        $pdf = new Fpdi();

        // Tambahkan halaman dari PDF potret
        $pageCount = $pdf->setSourceFile($portraitPath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $pdf->AddPage('P'); // 'P' untuk potret
            $tplId = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplId);
        }

        // Tambahkan halaman dari PDF lanskap
        $pageCount = $pdf->setSourceFile($landscapePath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $pdf->AddPage('L'); // 'L' untuk lanskap
            $tplId = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplId);
        }

        // Simpan atau streaming PDF yang digabungkan
        $nama_dokumen = 'RPS_' . $matkul->nama_matkul . '.pdf';
        return response($pdf->Output('I', $nama_dokumen))->header('Content-Type', 'application/pdf');
    }

    public function create_info_rps(string $id)
    {
        $matkul = Matkul::find($id);
        // dd($cepeel);
        $data['action'] = 'rps.store_info_rps';
        return view('rps.tambah_info', $data, compact('matkul'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_info_rps(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kajian' => 'required',
            'refrensi' => 'required',
        ]);

        $info = new InfoRPS();
        $info->id_matkul = $request->id_matkul;
        $info->deskripsi = $request->deskripsi;

        $value_kajian = implode(',', $request->kajian);
        $info->kajian = $value_kajian;

        $value_refrensi = implode(',', $request->refrensi);
        $info->refrensi = $value_refrensi;

        $info->save();

        return redirect('/rps/'.$request->id_matkul)->with('success', 'Informasi RPS berhasil ditambah!');
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit_info_rps(string $id)
    {
        $matkul = Matkul::find($id);
        $info = InfoRPS::where('id_matkul',$matkul->id)->first();
        $value_kajian = explode(',', $info->kajian);
        $count1= count($value_kajian)+1;
        $value_refrensi = explode(',', $info->refrensi);
        $count2= count($value_refrensi)+1;
        return view('rps.edit_info', compact('value_kajian','value_refrensi','info','matkul','count1','count2'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_info_rps(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kajian' => 'required',
            'refrensi' => 'required',
        ]);

        $info = InfoRPS::find($request->id);;
        $info->id_matkul = $request->id_matkul;
        $info->deskripsi = $request->deskripsi;

        $value_kajian = implode(',', $request->kajian);
        $info->kajian = $value_kajian;

        $value_refrensi = implode(',', $request->refrensi);
        $info->refrensi = $value_refrensi;

        $info->save();

        return redirect('/rps/'.$request->id_matkul)->with('success', 'Informasi RPS berhasil diedit!');
    }

    public function create_rincian_rps(string $id)
    {
        $matkul = Matkul::find($id);
        $count = $matkul->sks;
        $cpmk = Cpmk::where('id_matkul', $matkul->id)->get();
        $info = InfoRPS::where('id_matkul', $matkul->id)->first();
        $kajian = explode(',', $info->kajian);
        
        $fasilitator = Pengampu::where('id_matkul', $matkul->id)->first();
        $id_dsn = explode(',', $fasilitator->id_pengampu);
        $dosen = Dosen::whereIn('id',$id_dsn)->get();
        // dd($dosen);
        // dd($kajian);
        $data['action'] = 'rps.store_rincian_rps';
        return view('rps.tambah_rincian', $data, compact('matkul','cpmk','kajian','count','dosen'));
    }

    public function getBobotCpmk($sub_cpmk_id)
{
    $bobot = Bobot::where('id_cpmk', $sub_cpmk_id)->get(['id', 'pilihan_asesmen', 'bobot_cpmk', 'indikator_asesmen']);
    return response()->json($bobot);
}

    

    /**
     * Store a newly created resource in storage.
     */
    public function store_rincian_rps(Request $request)
    {
        // $request->validate([
        //     'bahan_kajian' => 'required',
        // ]);

        $rincian = new RincianRPS();
        $rincian->id_matkul = $request->id_matkul;
        $weeks = implode(',', $request->week);
        $rincian->week = $weeks;
        $rincian->sub_cpmk = $request->sub_cpmk;
        $rincian->asesmen = $request->bobot_cpmk;
        $rincian->kajian = $request->kajian;
        $metoda = implode(',', $request->metode);
        $rincian->metode = $metoda;
        $rincian->time = $request->time;
        $rincian->pengalaman = $request->pengalaman;
        $mediaa = implode(',', $request->media);
        $rincian->media = $mediaa;
        $fasilitators = implode(',', $request->fasilitator);
        $rincian->fasilitator = $fasilitators;
        $rincian->save();

        return redirect('/rps/'.$request->id_matkul)->with('success', 'Rincian RPS berhasil ditambah!');
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit_rincian_rps(string $id)
    {
        $rincian = RincianRPS::find($id);
        $matkul = Matkul::where('id',$rincian->id_matkul)->first();
        $count = $matkul->sks;
        $week = explode(',',$rincian->week);
        $cpmk = Cpmk::where('id_matkul', $matkul->id)->get();
        $asesmen = explode(',',$rincian->asesmen);
        $value_asesmen = '(' . $asesmen[1] . ' ' . $asesmen[2] . '%) ' . $asesmen[0];
        $info = InfoRPS::where('id_matkul', $matkul->id)->first();
        $kajian = explode(',', $info->kajian);
        $metode = explode(',',$rincian->metode);
        $media = explode(',',$rincian->media);
        $dosen = Dosen::all();
        $fasilitator = explode(',',$rincian->fasilitator);

        $fasilitator2 = Pengampu::where('id_matkul', $matkul->id)->first();
        $id_dsn = explode(',', $fasilitator2->id_pengampu);
        $dosenn = Dosen::whereIn('id',$id_dsn)->get();
        
        // dd($value_asesmen);
        // $kajian = Bkajian::where('id_matkul',$matkul->id)->first();
        // $value_kajian = explode(',', $kajian->bk);
        return view('rps.edit_rincian', compact('rincian','matkul','count','week','cpmk','value_asesmen','kajian','metode','media','dosen','fasilitator','dosenn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_rincian_rps(Request $request)
    {

        $rincian = RincianRPS::find($request->id);;
        $rincian->id_matkul = $request->id_matkul;
        $weeks = implode(',', $request->week);
        $rincian->week = $weeks;
        $rincian->sub_cpmk = $request->sub_cpmk;
        $rincian->asesmen = $request->bobot_cpmk;
        $rincian->kajian = $request->kajian;
        $metoda = implode(',', $request->metode);
        $rincian->metode = $metoda;
        $rincian->time = $request->time;
        $rincian->pengalaman = $request->pengalaman;
        $mediaa = implode(',', $request->media);
        $rincian->media = $mediaa;
        $fasilitators = implode(',', $request->fasilitator);
        $rincian->fasilitator = $fasilitators;
        $rincian->save();

        return redirect('/rps/'.$request->id_matkul)->with('success', 'Rincian RPS berhasil diedit!');
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
        return redirect('/cpmk/'.$matkul->id)->with('hapus', 'Data CPMK beserta Bobotnya berhasil dihapus!');
    }

}
