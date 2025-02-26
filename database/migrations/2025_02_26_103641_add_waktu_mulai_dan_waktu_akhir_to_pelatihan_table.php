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
        Schema::table('pelatihan', function (Blueprint $table) {
            // Menambahkan kolom waktu_mulai dan waktu_akhir sebagai kolom bertipe time
            $table->time('waktu_mulai')->nullable()->after('tanggal_pelatihan');
            $table->time('waktu_akhir')->nullable()->after('waktu_mulai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihan', function (Blueprint $table) {
            $table->dropColumn(['waktu_mulai', 'waktu_akhir']);
        });
    }
};
