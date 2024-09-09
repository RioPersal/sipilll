<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PesertaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $kelas = $row['kelas'];
        $nama = $row['nama_mahasiswa'];
        $id_mahasiswa = Mahasiswa::where('nama',$nama)->first();
        $matakuliah = $row['mata_kuliah'];
        $id_matkul = Matkul::where('nama_matkul',$matakuliah)->first();
        $id_kelas = Kelas::where('nama_kelas',$row['kelas'])->where('id_matkul',$id_matkul->id)->first();
        return new Peserta([
            'id_kelas' => $id_kelas->id,
            'id_mahasiswa' => $id_mahasiswa->id,
        ]);
    }
}
