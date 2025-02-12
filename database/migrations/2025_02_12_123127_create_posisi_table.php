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
        Schema::create('posisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_divisi')->constrained('divisi')->onDelete('cascade');
            $table->string('nama_posisi')->unique();
            $table->decimal('gaji_pokok', 12, 2);
            $table->decimal('tunjangan', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posisi');
    }
};
