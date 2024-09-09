<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $mahasiswa = new Mahasiswa([
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'angkatan' => $row['angkatan'],
        ]);

        $user = new User([
            'username' => $row['nim'],
            'name' => $row['nama'],
            'level' => 'mahasiswa',
            'password' => Hash::make($row['nim']),
        ]);

        // Simpan kedua model
        $mahasiswa->save();
        $user->save();
    }
}
