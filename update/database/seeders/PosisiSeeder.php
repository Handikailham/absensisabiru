<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posisi;

class PosisiSeeder extends Seeder {
    public function run(): void {
        // Data posisi tanpa id_divisi
        $posisiData = [
            ['nama_posisi' => 'Web Front End Developer', 'gaji_pokok' => 8000000, 'tunjangan' => 2000000],
            ['nama_posisi' => 'Web Back End Developer', 'gaji_pokok' => 9000000, 'tunjangan' => 2500000],
            ['nama_posisi' => 'Web Project Manager', 'gaji_pokok' => 12000000, 'tunjangan' => 3000000],
            ['nama_posisi' => 'Web System Analyst', 'gaji_pokok' => 11000000, 'tunjangan' => 2800000],

            ['nama_posisi' => 'Mobile Front End Developer', 'gaji_pokok' => 8500000, 'tunjangan' => 2200000],
            ['nama_posisi' => 'Mobile Back End Developer', 'gaji_pokok' => 9500000, 'tunjangan' => 2700000],
            ['nama_posisi' => 'Mobile Project Manager', 'gaji_pokok' => 12500000, 'tunjangan' => 3200000],
            ['nama_posisi' => 'Mobile System Analyst', 'gaji_pokok' => 11500000, 'tunjangan' => 2900000],

            ['nama_posisi' => 'Game Front End Developer', 'gaji_pokok' => 8700000, 'tunjangan' => 2300000],
            ['nama_posisi' => 'Game Back End Developer', 'gaji_pokok' => 9700000, 'tunjangan' => 2800000],
            ['nama_posisi' => 'Game Project Manager', 'gaji_pokok' => 12800000, 'tunjangan' => 3500000],
            ['nama_posisi' => 'Game System Analyst', 'gaji_pokok' => 11800000, 'tunjangan' => 3100000],
        ];

        // Insert data ke dalam tabel posisi
        Posisi::insert($posisiData);
    }
}
