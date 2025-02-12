<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migration untuk menghapus kolom id_divisi.
     */
    public function up(): void {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropForeign(['id_divisi']); // Hapus foreign key jika ada
            $table->dropColumn('id_divisi'); // Hapus kolom id_divisi
        });
    }

    /**
     * Kembalikan perubahan jika diperlukan (rollback).
     */
    public function down(): void {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->foreignId('id_divisi')->constrained('divisi')->onDelete('cascade');
        });
    }
};
