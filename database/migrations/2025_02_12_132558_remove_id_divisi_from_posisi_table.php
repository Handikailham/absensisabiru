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
        Schema::table('posisi', function (Blueprint $table) {
            $table->dropForeign(['id_divisi']); // Hapus foreign key constraint
            $table->dropColumn('id_divisi'); // Hapus kolom id_divisi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posisi', function (Blueprint $table) {
            $table->foreignId('id_divisi')->constrained('divisi')->onDelete('cascade'); // Tambahkan kembali jika rollback
        });
    }
};
