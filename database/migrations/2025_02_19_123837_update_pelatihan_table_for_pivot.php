<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Buat pivot table pelatihan_posisi
        Schema::create('pelatihan_posisi', function (Blueprint $table) {
            $table->unsignedBigInteger('pelatihan_id');
            $table->unsignedBigInteger('posisi_id');
            $table->primary(['pelatihan_id', 'posisi_id']);

            $table->foreign('pelatihan_id')->references('id')->on('pelatihan')->onDelete('cascade');
            $table->foreign('posisi_id')->references('id')->on('posisi')->onDelete('cascade');
        });

        // 2. Transfer data dari kolom posisi_id di tabel pelatihan ke pivot table
        $pelatihans = DB::table('pelatihan')->select('id', 'posisi_id')->get();
        foreach ($pelatihans as $pelatihan) {
            if ($pelatihan->posisi_id) {
                DB::table('pelatihan_posisi')->insert([
                    'pelatihan_id' => $pelatihan->id,
                    'posisi_id'    => $pelatihan->posisi_id,
                ]);
            }
        }

        // 3. Hapus kolom posisi_id dari tabel pelatihan
        Schema::table('pelatihan', function (Blueprint $table) {
            $table->dropForeign(['posisi_id']);
            $table->dropColumn('posisi_id');
        });
    }

    public function down(): void
    {
        // Untuk rollback, kita kembalikan kolom posisi_id di tabel pelatihan
        Schema::table('pelatihan', function (Blueprint $table) {
            $table->unsignedBigInteger('posisi_id')->nullable()->after('deskripsi');
        });

        // Pindahkan data dari pivot table kembali ke tabel pelatihan
        $pelatihanPosisi = DB::table('pelatihan_posisi')->get();
        foreach ($pelatihanPosisi as $pp) {
            DB::table('pelatihan')
                ->where('id', $pp->pelatihan_id)
                ->update(['posisi_id' => $pp->posisi_id]);
        }

        // Hapus pivot table
        Schema::dropIfExists('pelatihan_posisi');
    }
};
