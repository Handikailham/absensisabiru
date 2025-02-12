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
            // Menambahkan kolom id_divisi (nullable agar tidak error jika data karyawan sudah ada)
            $table->foreignId('id_divisi')->nullable()->after('role')->constrained('divisi')->onDelete('set null');

            // Menambahkan kolom id_posisi (nullable agar tidak error jika data karyawan sudah ada)
            $table->foreignId('id_posisi')->nullable()->after('id_divisi')->constrained('posisi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropForeign(['id_divisi']);
            $table->dropForeign(['id_posisi']);
            $table->dropColumn(['id_divisi', 'id_posisi']);
        });
    }
};
