<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilTes extends Model
{
    use HasFactory;

    protected $table = 'hasil_tes';

    protected $fillable = [
        'pelatihan_id',
        'karyawan_id',
        'total_soal',
        'jumlah_benar',
        'jumlah_salah',
        'status',
        'tes_selesai',
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
