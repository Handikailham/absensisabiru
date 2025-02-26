<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanRequest extends Model
{
    use HasFactory;

    protected $table = 'pelatihan_requests';

    protected $fillable = [
        'pelatihan_id',
        'karyawan_id',
        'status'
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
