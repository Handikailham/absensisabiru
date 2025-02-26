<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTesSelesaiToHasilTesTable extends Migration
{
    public function up()
    {
        Schema::table('hasil_tes', function (Blueprint $table) {
            $table->boolean('tes_selesai')->default(false)->after('status');
        });
    }

    public function down()
    {
        Schema::table('hasil_tes', function (Blueprint $table) {
            $table->dropColumn('tes_selesai');
        });
    }
}
