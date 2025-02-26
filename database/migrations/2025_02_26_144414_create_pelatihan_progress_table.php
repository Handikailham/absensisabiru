<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihanProgressTable extends Migration
{
    public function up()
    {
        Schema::create('pelatihan_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
            // Perhatikan: gunakan 'pelatihan' (bukan pelatihans) sesuai dengan nama tabel Anda
            $table->foreignId('pelatihan_id')->constrained('pelatihan')->onDelete('cascade');
            // Simpan indeks subtes terakhir yang dikerjakan (misalnya 0 untuk subtes pertama)
            $table->integer('sub_tes_index')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelatihan_progress');
    }
}
