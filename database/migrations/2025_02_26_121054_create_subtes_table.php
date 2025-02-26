<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subtes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelatihan_id');
            $table->string('nama_subtes');
            $table->integer('durasi')->comment('Durasi sub tes dalam menit');
            $table->integer('urutan')->default(1)->comment('Urutan sub tes dalam pelatihan');
            $table->timestamps();

            $table->foreign('pelatihan_id')->references('id')->on('pelatihan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subtes');
    }
};
