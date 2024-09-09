<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $dosen = new Dosen([
            'nidn' => $row['nidn'],
            'nama' => $row['nama'],
            'gelar_depan' => $row['gelardepan'],
            'gelar_belakang' => $row['gelarbelakang'],
        ]);

        // $nama = implode(' ', [$row['gelardepan'], $row['nama'], $row['gelarbelakang']]);
// dd($nama);
        $user = new User([
            'username' => $row['nidn'],
            'name' => $row['nama'],
            'level' => 'dosen',
            'password' => Hash::make($row['nidn']),
            'gelar_depan' => $row['gelardepan'],
            'gelar_belakang' => $row['gelarbelakang'],
        ]);

        // Simpan kedua model
        $dosen->save();
        $user->save();
    }
}
