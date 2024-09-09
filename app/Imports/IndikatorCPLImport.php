<?php

namespace App\Imports;

use App\Models\Cepeel;
use App\Models\IndikatorCPL;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IndikatorCPLImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $kode_cpl = $row['cpl'];

        $cpl = Cepeel::where('kode_cpl',$kode_cpl)->first();

        if ($cpl) {
            return new IndikatorCPL([
                'id_cpl' => $cpl->id,
                'indikator' => $row['indikator'],
                'ket_indikator' => $row['keterangan'],
            ]);
        }

        return null;
    }
}
