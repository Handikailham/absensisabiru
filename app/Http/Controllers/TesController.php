<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Soal;
use App\Models\Subtes;
use App\Models\HasilTes;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TesController extends Controller
{
    // Menampilkan halaman tes (sub-tes) untuk pelatihan tertentu
    public function mulai($pelatihan_id, $sub_tes_index = null)
    {
        session()->put('subtes_start_time', Carbon::now()->timestamp);
        $karyawan = Auth::user();

        // Periksa apakah sudah ada record progres untuk pelatihan ini
        $progress = \App\Models\PelatihanProgress::where('pelatihan_id', $pelatihan_id)
                    ->where('karyawan_id', $karyawan->id)
                    ->first();

        if ($progress && is_null($sub_tes_index)) {
            // Jika progres ada dan parameter sub_tes_index tidak diberikan, gunakan nilai progres
            $sub_tes_index = $progress->sub_tes_index;
        } elseif (is_null($sub_tes_index)) {
            // Jika belum ada progres, mulai dari indeks 0 (subtes pertama)
            $sub_tes_index = 0;
        }

        // Ambil pelatihan beserta subtes (diurutkan) dan soal-soalnya
        $pelatihan = Pelatihan::with(['subtes' => function($query) {
            $query->orderBy('urutan');
        }, 'subtes.soal'])->findOrFail($pelatihan_id);

        $subtesList = $pelatihan->subtes->values(); // Reset indeks

        // Jika tidak ada subtes, langsung arahkan ke halaman hasil
        if ($subtesList->isEmpty()) {
            return redirect()->route('pelatihan.hasil', $pelatihan_id);
        }

        // Jika indeks melebihi jumlah subtes, arahkan ke halaman hasil
        if ($sub_tes_index >= $subtesList->count()) {
            return redirect()->route('pelatihan.hasil', $pelatihan_id);
        }

        $currentSubtes = $subtesList[$sub_tes_index];

        return view('tes.index', compact('pelatihan', 'currentSubtes', 'sub_tes_index'));
    }

    // Memproses submit jawaban untuk sub-tes tertentu dan simpan ke database
    public function submitSubtes(Request $request, $pelatihan_id, $sub_tes_index)
{
    $request->validate([
        'jawaban' => 'required|array'
    ]);

    $karyawan = Auth::user();
    $pelatihan = Pelatihan::with(['subtes.soal'])->findOrFail($pelatihan_id);
    $subtesList = $pelatihan->subtes->sortBy('urutan')->values();

    if ($sub_tes_index >= $subtesList->count()) {
        return redirect()->route('pelatihan.hasil', $pelatihan_id);
    }

    $currentSubtes = $subtesList[$sub_tes_index];
    $jawabanUser = $request->input('jawaban');
    $jumlah_soal = $currentSubtes->soal->count();
    $jumlah_benar = 0;

    foreach ($currentSubtes->soal as $soal) {
        if (isset($jawabanUser[$soal->id]) && $jawabanUser[$soal->id] == $soal->jawaban_benar) {
            $jumlah_benar++;
        }
    }

    // Gunakan timestamp (detik) untuk menyimpan waktu mulai
    $startTime = session()->get('subtes_start_time');
    if (!$startTime) {
        // Fallback jika session tidak ada (seharusnya tidak terjadi)
        $startTime = Carbon::now()->timestamp;
    }
    $endTime = Carbon::now()->timestamp;
    $durationInSeconds = $endTime - $startTime;

    // Ambil record HasilTes jika ada, atau buat baru
    $hasilTes = HasilTes::where('pelatihan_id', $pelatihan_id)
                ->where('karyawan_id', $karyawan->id)
                ->first();

    if (!$hasilTes) {
        $durationFormatted = gmdate("H:i:s", $durationInSeconds);
        $hasilTes = HasilTes::create([
            'pelatihan_id' => $pelatihan_id,
            'karyawan_id'  => $karyawan->id,
            'total_soal'   => $jumlah_soal,
            'jumlah_benar' => $jumlah_benar,
            'jumlah_salah' => $jumlah_soal - $jumlah_benar,
            'status'       => ($jumlah_soal > 0 && (($jumlah_benar / $jumlah_soal) * 100) >= 75) ? 'kompeten' : 'tidak kompeten',
            'tes_selesai'  => false,
            'durasi_tes'   => $durationFormatted,
        ]);
    } else {
        $new_total_soal   = $hasilTes->total_soal + $jumlah_soal;
        $new_jumlah_benar = $hasilTes->jumlah_benar + $jumlah_benar;
        $new_jumlah_salah = $new_total_soal - $new_jumlah_benar;
        $new_status = ($new_total_soal > 0 && (($new_jumlah_benar / $new_total_soal) * 100) >= 75) ? 'kompeten' : 'tidak kompeten';

        // Jika sudah ada durasi sebelumnya, ubah ke detik dan jumlahkan
        if ($hasilTes->durasi_tes) {
            list($h, $m, $s) = explode(':', $hasilTes->durasi_tes);
            $previousSeconds = ($h * 3600) + ($m * 60) + $s;
        } else {
            $previousSeconds = 0;
        }
        $totalSeconds = $previousSeconds + $durationInSeconds;
        $durationFormatted = gmdate("H:i:s", $totalSeconds);

        $hasilTes->update([
            'total_soal'   => $new_total_soal,
            'jumlah_benar' => $new_jumlah_benar,
            'jumlah_salah' => $new_jumlah_salah,
            'status'       => $new_status,
            'durasi_tes'   => $durationFormatted,
        ]);
    }

    // Hapus waktu mulai dari session
    session()->forget('subtes_start_time');

    // Update progres di tabel pelatihan_progress
    $progress = \App\Models\PelatihanProgress::updateOrCreate(
        ['pelatihan_id' => $pelatihan_id, 'karyawan_id' => $karyawan->id],
        ['sub_tes_index' => $sub_tes_index + 1]
    );

    // Jika masih ada subtes berikutnya, simpan waktu mulai baru sebagai timestamp dan redirect
    if ($sub_tes_index + 1 < $subtesList->count()) {
        session()->put('subtes_start_time', Carbon::now()->timestamp);
        return redirect()->route('pelatihan.mulai', [$pelatihan_id, $sub_tes_index + 1])
            ->with('success', "Sub Tes " . ($sub_tes_index + 1) . " selesai.");
    } else {
        $hasilTes->update(['tes_selesai' => true]);
        $progress->delete();
        return redirect()->route('pelatihan.hasil', $pelatihan_id)
            ->with('success', "Semua Sub Tes telah selesai.");
    }
}






    // Menampilkan halaman hasil tes dari database
    public function hasil($pelatihan_id)
    {
        $pelatihan = Pelatihan::findOrFail($pelatihan_id);
        $hasil = HasilTes::where('pelatihan_id', $pelatihan_id)
                    ->where('karyawan_id', Auth::user()->id)
                    ->first();
        return view('tes.hasil', compact('pelatihan', 'hasil'));
    }
}
