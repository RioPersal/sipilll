<?php

namespace App\Imports;

use App\Models\IndikatorCPL;
use App\Models\Matkul;
use App\Models\MatkulInd;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MatkulIndImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $matkul = Matkul::where('nama_matkul',$row['nama_matkul'])->first();

        $indikator = explode(', ',$row['indikator_cpl']) ;
        $id_indikator = IndikatorCPL::whereIn('indikator',$indikator)->pluck('id');
        
        $bobot = explode(', ',$row['bobot_indikator']) ;

        foreach ($id_indikator as $key => $id) {
            MatkulInd::create([
                'id_matkul' => $matkul->id,
                'id_indikator' => $id,
                'bobot_indikator' => $bobot[$key],
            ]);
        }
    }
}
