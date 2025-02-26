<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanProgress extends Model
{
    use HasFactory;

    protected $fillable = ['karyawan_id', 'pelatihan_id', 'sub_tes_index'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }
}
