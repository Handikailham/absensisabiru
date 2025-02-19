<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;

    protected $table = 'pelatihan';

    protected $fillable = [
        'nama_pelatihan',
        'tanggal_pendaftaran',
        'tanggal_pelatihan',
        'alamat',
        'deskripsi'
    ];

    // Relasi many-to-many ke model Posisi
    public function posisis()
    {
        return $this->belongsToMany(Posisi::class, 'pelatihan_posisi', 'pelatihan_id', 'posisi_id');
    }

    public function requests()
    {
        return $this->hasMany(PelatihanRequest::class, 'pelatihan_id');
    }
}
