<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kaprodis = Kaprodi::all();
        $data['kaprodi'] = $kaprodis;
        return view('data_kaprodi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosen = Dosen::all();
        $data['action'] = 'kaprodi.store';
        return view('data_kaprodi.tambah', $data, compact('dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_kaprodi' => 'required',
        ]);

        $dosen = Dosen::find($request->id_kaprodi);
// dd($id_dosen);
        $kaprodi = new Kaprodi;
        $kaprodi->nidn = $dosen->nidn;
        $kaprodi->nama = $dosen->nama;
        $kaprodi->gelar_depan = $dosen->gelar_depan;
        $kaprodi->gelar_belakang = $dosen->gelar_belakang;
        $kaprodi->save();
        
        $kaprodi2 = new User;
        $kaprodi2->name = $dosen->nama;
        $kaprodi2->username = 'kaprodi'.$dosen->nidn;
        $kaprodi2->gelar_depan = $dosen->gelar_depan;
        $kaprodi2->gelar_belakang = $dosen->gelar_belakang;
        $kaprodi2->level = 'kaprodi';
        $kaprodi2->password = Hash::make('kaprodi'.$dosen->nidn);
        $kaprodi2->save();

        return redirect('/data-kaprodi')->with('success', 'Data Kaprodi berhasil ditambah!');
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
        $kaprodis = Kaprodi::find($id);
        $dosens = Dosen::all();
        // dd($kaprodis);
        $user = User::where('name',$kaprodis->nama)->first();
        // dd($user);
        $data['kaprodi'] = $kaprodis;
        return view('data_kaprodi.edit', $data, compact('user','dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $dosen = Dosen::where('nama',$request->nama)->first();
        // dd($dosen);
        $kaprodi = Kaprodi::find($request->id);
        $kaprodi->nama = $request->nama;
        $kaprodi->gelar_depan = $dosen->gelar_depan;
        $kaprodi->gelar_belakang = $dosen->gelar_belakang;
        $kaprodi->save();

        User::where('username', 'kaprodi')->delete();
        // dd($kaprodin);

        $kaprodi2 = new User;
        // dd($request->nama);
        $kaprodi2->name = $request->nama;
        $kaprodi2->username = $request->username;
        $kaprodi2->level = 'kaprodi';
        if ($request->password == null) {
            $kaprodi2->password = Hash::make('12345678');
        } else {
            $kaprodi2->password = Hash::make($request->password);
        }
        $kaprodi2->gelar_depan = $dosen->gelar_depan;
        $kaprodi2->gelar_belakang = $dosen->gelar_belakang;
        $kaprodi2->save();

        return redirect('/data-kaprodi')->with('success', 'Data Kaprodi berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kaprodi::where('id', $id)->delete();
        // return redirect('/dashboard/bukti')->with('hapus', 'Data tanda bukti pembayaran berhasil dihapus!');
        return redirect('/data-kaprodi')->with('hapus', 'Data Kaprodi berhasil dihapus!');
    }
}
