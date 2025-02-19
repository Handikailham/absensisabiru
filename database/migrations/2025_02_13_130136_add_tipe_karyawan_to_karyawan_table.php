<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            // Tambahkan kolom tipe_karyawan dengan opsi: tetap, kontrak, magang
            $table->enum('tipe_karyawan', ['tetap', 'kontrak', 'magang'])
                  ->after('role')
                  ->default('tetap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropColumn('tipe_karyawan');
        });
    }
};
