<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->foreignId('id_posisi')->nullable()->constrained('posisi')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropForeign(['id_posisi']);
            $table->dropColumn('id_posisi');
        });
    }
};

