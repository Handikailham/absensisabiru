<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pelatihan_posisi', function (Blueprint $table) {
            $table->unsignedBigInteger('pelatihan_id');
            $table->unsignedBigInteger('posisi_id');
            $table->primary(['pelatihan_id', 'posisi_id']);
            
            $table->foreign('pelatihan_id')->references('id')->on('pelatihan')->onDelete('cascade');
            $table->foreign('posisi_id')->references('id')->on('posisi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelatihan_posisi');
    }
};
