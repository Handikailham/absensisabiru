<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('hasil_tes', function (Blueprint $table) {
            $table->dropColumn('total_soal');
        });
    }

    /**
     * Kembalikan migrasi.
     */
    public function down(): void
    {
        Schema::table('hasil_tes', function (Blueprint $table) {
            $table->integer('total_soal')->nullable();
        });
    }
};
