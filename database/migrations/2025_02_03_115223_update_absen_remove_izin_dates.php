<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('absens', function (Blueprint $table) {
            $table->dropColumn(['izin_mulai', 'izin_selesai']);
        });
    }

    public function down()
    {
        Schema::table('absens', function (Blueprint $table) {
            $table->date('izin_mulai')->nullable();
            $table->date('izin_selesai')->nullable();
        });
    }
};

