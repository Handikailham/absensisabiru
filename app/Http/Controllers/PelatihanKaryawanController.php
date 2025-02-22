<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use App\Models\PelatihanRequest;
use Illuminate\Support\Facades\Auth;

class PelatihanKaryawanController extends Controller
{
    public function index()
{
    $karyawan = Auth::user();
    $today = \Carbon\Carbon::today(); // Mendapatkan tanggal hari ini

    // Ambil pelatihan yang sesuai dengan posisi karyawan dan tanggal pendaftaran belum lewat
    $pelatihan = Pelatihan::whereHas('posisis', function($query) use ($karyawan) {
        $query->where('posisi_id', $karyawan->id_posisi);
    })
    ->whereDate('tanggal_pendaftaran', '>=', $today)
    ->get();

    return view('pelatihankaryawan.index', compact('pelatihan'));
}


public function requestJoin($id)
    {
        $karyawan = Auth::user(); // Ambil data karyawan yang login

        // Cek apakah karyawan sudah mengajukan permintaan untuk pelatihan ini
        $existingRequest = PelatihanRequest::where('pelatihan_id', $id)
            ->where('karyawan_id', $karyawan->id)
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan permintaan untuk pelatihan ini.');
        }

        // Buat record permintaan pelatihan dengan status "pending"
        PelatihanRequest::create([
            'pelatihan_id' => $id,
            'karyawan_id'  => $karyawan->id,
            'status'       => 'pending'
        ]);

        return redirect()->back()->with('success', 'Permintaan pelatihan telah dikirim.');
    }

}
