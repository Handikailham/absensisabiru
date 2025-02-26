<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable
{
    use Notifiable;

    protected $table = 'karyawan';
    protected $fillable = ['nama','id_posisi','tipe_karyawan', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    public function posisi() {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }
}