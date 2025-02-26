<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hasil_tes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelatihan_id');
            $table->unsignedBigInteger('karyawan_id');
            $table->integer('total_soal');
            $table->integer('jumlah_benar');
            $table->integer('jumlah_salah');
            $table->enum('status', ['kompeten', 'tidak kompeten']);
            $table->timestamps();

            $table->foreign('pelatihan_id')->references('id')->on('pelatihan')->onDelete('cascade');
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_tes');
    }
};
