<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurasiTesToHasilTesTable extends Migration
{
    public function up()
    {
        Schema::table('hasil_tes', function (Blueprint $table) {
            $table->time('durasi_tes')->nullable()->after('tes_selesai');
        });
    }

    public function down()
    {
        Schema::table('hasil_tes', function (Blueprint $table) {
            $table->dropColumn('durasi_tes');
        });
    }
}
