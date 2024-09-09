<?php

namespace App\Imports;

use App\Models\Matkul;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MatkulImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $semester = $row[7];
        $sks1 = $row['teori'];
        $sks2 = $row['praktek'];
        $sks3 = $row['pl'];
        return new Matkul([
            'kode_matkul' => $row['kode'],
            'nama_matkul' => $row['nama'],
            'semester' => $semester,
            'sks' => $sks1 + $sks2 + $sks3,
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
