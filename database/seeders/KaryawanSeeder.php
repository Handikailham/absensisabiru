<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        Karyawan::create([
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        Karyawan::create([
            'nama' => 'Karyawan 1',
            'email' => 'karyawan1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
        ]);
    }
}