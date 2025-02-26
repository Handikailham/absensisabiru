<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    // Isi kolom yang dapat diisi massal
    protected $fillable = [
        'sub_tes_id', 'pertanyaan', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban_benar'
    ];

    // Relasi: Soal milik Subtes
    public function subtes()
    {
        return $this->belongsTo(Subtes::class, 'sub_tes_id');
    }
}
