<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasFactory;

    protected $table = 'posisi';

    protected $fillable = ['nama_posisi'];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_posisi');
    }

    public function pelatihans()
    {
        return $this->belongsToMany(Pelatihan::class, 'pelatihan_posisi', 'posisi_id', 'pelatihan_id');
    }
}


