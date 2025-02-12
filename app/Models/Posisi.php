<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model {
    use HasFactory;
    protected $table = 'posisi';
    protected $fillable = ['id_divisi', 'nama_posisi', 'gaji_pokok', 'tunjangan'];

    public function divisi() {
        return $this->belongsTo(Divisi::class);
    }
}

