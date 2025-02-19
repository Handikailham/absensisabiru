<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model {
    use HasFactory;

    protected $table = 'gaji';
    protected $fillable = ['id_karyawan', 'id_posisi', 'lembur', 'bonus', 'total_gaji', 'tanggal_gajian'];

    // Relasi ke tabel Karyawan
    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    // Relasi ke tabel Posisi
    public function posisi() {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }
}
