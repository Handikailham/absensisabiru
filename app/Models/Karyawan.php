<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Karyawan extends Authenticatable
{
    use Notifiable;

    protected $table = 'karyawan';
    protected $fillable = ['nama','email', 'profile_image', 'password', 'role', 'tipe_karyawan', 'id_posisi'];
    protected $hidden = ['password', 'remember_token'];

    public function posisi() {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }
}