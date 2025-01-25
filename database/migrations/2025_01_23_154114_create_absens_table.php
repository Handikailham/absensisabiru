<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('absens', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('karyawan_id');
        $table->date('tanggal');
        $table->time('jam_masuk')->nullable();
        $table->time('jam_pulang')->nullable();
        $table->enum('status', ['hadir', 'terlambat', 'izin'])->default('hadir');
        $table->timestamps();

        $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absens');
    }
};
