<?php

namespace App\Imports;

use App\Models\Cepeel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CepeelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cepeel([
            'kode_cpl' => $row['kode'],
            'keterangan' => $row['keterangan'],
        ]);
    }
}
