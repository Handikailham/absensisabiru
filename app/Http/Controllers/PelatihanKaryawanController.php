<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\HasilTes;
use App\Models\Karyawan;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use App\Models\PelatihanRequest;
use Illuminate\Support\Facades\Auth;

class PelatihanKaryawanController extends Controller
{
    // Menampilkan pelatihan terbaru (yang belum di-join) untuk karyawan
    public function index()
    {
        $karyawan = Auth::user();
        $today = Carbon::today(); // Tanggal hari ini

        // Ambil pelatihan sesuai posisi karyawan, dengan tanggal pendaftaran >= hari ini,
        // dan yang belum ada request dari karyawan tersebut.
        $pelatihan = Pelatihan::whereHas('posisis', function($query) use ($karyawan) {
                $query->where('posisi_id', $karyawan->id_posisi);
            })
            ->whereDate('tanggal_pendaftaran', '>=', $today)
            ->whereDoesntHave('requests', function($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            ->get();

        // Tandai setiap pelatihan apakah pendaftaran sudah dibuka (jika tanggal pendaftaran = hari ini)
        $pelatihan->each(function ($p) use ($today) {
            $p->registration_open = Carbon::parse($p->tanggal_pendaftaran)->isSameDay($today);
        });

        return view('pelatihankaryawan.index', compact('pelatihan'));
    }

    // Menampilkan pelatihan yang sudah di-join/request oleh karyawan
    public function requested()
{
    $karyawan = Auth::user();

    // Ambil semua permintaan pelatihan oleh karyawan
    $requestPelatihan = PelatihanRequest::where('karyawan_id', $karyawan->id)->get();

    // Ambil pelatihan berdasarkan ID yang ada di permintaan
    $pelatihan = Pelatihan::whereIn('id', $requestPelatihan->pluck('pelatihan_id'))->get();

    foreach ($pelatihan as $p) {
        // Ambil record HasilTes untuk pelatihan ini
        $hasil = HasilTes::where('pelatihan_id', $p->id)
                    ->where('karyawan_id', $karyawan->id)
                    ->first();
        // Jika ada record, ambil nilai tes_selesai; jika tidak, false
        $p->tes_selesai = $hasil ? $hasil->tes_selesai : false;
        // Tandai apakah tes sudah dimulai (record HasilTes ada)
        $p->tes_started = $hasil ? true : false;

        // Ambil status request khusus karyawan
        $request = $p->requests->where('karyawan_id', $karyawan->id)->first();
        if ($request) {
            $p->request_status = $request->status;
        }
        // Jika request sudah diterima, hitung waktu target untuk countdown
        if (isset($p->request_status) && $p->request_status == 'accepted') {
            $p->target_time = Carbon::parse($p->tanggal_pelatihan . ' ' . $p->waktu_mulai)
                                ->format('Y-m-d H:i:s');
        }
    }

    // Pisahkan pelatihan yang sudah selesai dan belum selesai
    $pelatihanSelesai = $pelatihan->filter(function ($p) {
        return $p->tes_selesai;
    });

    $pelatihanBelumSelesai = $pelatihan->filter(function ($p) {
        return !$p->tes_selesai;
    });

    return view('pelatihankaryawan.requested', compact('pelatihanSelesai', 'pelatihanBelumSelesai'));
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
