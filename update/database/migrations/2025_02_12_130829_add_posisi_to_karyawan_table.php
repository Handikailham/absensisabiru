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
            // Periksa apakah kolom id_posisi belum ada
            if (!Schema::hasColumn('karyawan', 'id_posisi')) {
                $table->foreignId('id_posisi')->nullable()->constrained('posisi')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            if (Schema::hasColumn('karyawan', 'id_posisi')) {
                $table->dropForeign(['id_posisi']);
                $table->dropColumn('id_posisi');
            }
        });
    }
};
