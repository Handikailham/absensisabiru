<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
        'izin_mulai',
        'izin_selesai',
        'alasan',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}

