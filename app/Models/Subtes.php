<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtes extends Model
{
    use HasFactory;

    protected $table = 'subtes';

    // Isi kolom yang dapat diisi massal
    protected $fillable = ['pelatihan_id', 'nama_subtes', 'durasi', 'urutan'];

    // Relasi: Subtes milik Pelatihan
    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }

    // Relasi: Subtes memiliki banyak Soal
    public function soal()
    {
        return $this->hasMany(Soal::class, 'sub_tes_id');
    }
}
