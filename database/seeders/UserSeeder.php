<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Kaprodi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data pengguna
        $data = [
            ['username' => 'admin', 'name' => 'Admin', 'level' => 'admin', 'password' => bcrypt('12345678')],
            ['username' => 'kaprodi', 'name' => 'Kaprodi', 'level' => 'kaprodi', 'password' => bcrypt('12345678')],
            // Tambahkan data lainnya sesuai kebutuhan
        ];
        
        $data2 = [
            ['nama' => 'Admin'],
            // Tambahkan data lainnya sesuai kebutuhan
        ];
        
        $data3 = [
            ['nama' => 'Kaprodi'],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Gunakan Eloquent atau Query Builder untuk menyimpan data
        User::insert($data);
        Admin::insert($data2);
        Kaprodi::insert($data3);
    }
}
