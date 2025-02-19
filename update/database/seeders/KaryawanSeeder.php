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
            'password' => Hash::make('123456'),
            'role' => 'karyawan',
        ]);
        Karyawan::create([
            'nama' => 'Karyawan 2',
            'email' => 'karyawan2@example.com',
            'password' => Hash::make('123456'),
            'role' => 'karyawan',
        ]);
        Karyawan::create([
            'nama' => 'Karyawan 3',
            'email' => 'karyawan3@example.com',
            'password' => Hash::make('123456'),
            'role' => 'karyawan',
        ]);
        Karyawan::create([
            'nama' => 'Karyawan 4',
            'email' => 'karyawan4@example.com',
            'password' => Hash::make('123456'),
            'role' => 'karyawan',
        ]);
        Karyawan::create([
            'nama' => 'Karyawan 5',
            'email' => 'karyawan5@example.com',
            'password' => Hash::make('123456'),
            'role' => 'karyawan',
        ]);
    }
}