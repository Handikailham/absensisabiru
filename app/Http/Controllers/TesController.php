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
        // Simpan waktu mulai sebagai string ISO (agar tidak terjadi perbedaan saat konversi)
        session()->put('subtes_start_time', Carbon::now()->toDateTimeString());
        $karyawan = Auth::user();

        // Periksa apakah sudah ada record progres untuk pelatihan ini
        $progress = \App\Models\PelatihanProgress::where('pelatihan_id', $pelatihan_id)
                    ->where('karyawan_id', $karyawan->id)
                    ->first();

        if ($progress && is_null($sub_tes_index)) {
            $sub_tes_index = $progress->sub_tes_index;
        } elseif (is_null($sub_tes_index)) {
            $sub_tes_index = 0;
        }

        // Ambil pelatihan beserta subtes (diurutkan) dan soal-soalnya
        $pelatihan = Pelatihan::with([
            'subtes' => function($query) {
                $query->orderBy('urutan');
            },
            'subtes.soal'
        ])->findOrFail($pelatihan_id);

        $subtesList = $pelatihan->subtes->values();

        if ($subtesList->isEmpty() || $sub_tes_index >= $subtesList->count()) {
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
        $jumlah_soal_current = $currentSubtes->soal->count();
        $jumlah_benar = 0;

        foreach ($currentSubtes->soal as $soal) {
            if (isset($jawabanUser[$soal->id]) && $jawabanUser[$soal->id] == $soal->jawaban_benar) {
                $jumlah_benar++;
            }
        }

        // Ambil waktu mulai dari session menggunakan Carbon::parse()
        $startTimeRaw = session()->get('subtes_start_time');
        $startTime = $startTimeRaw ? Carbon::parse($startTimeRaw) : Carbon::now();
        $endTime = Carbon::now();
        $durationInSeconds = $endTime->diffInSeconds($startTime);
        $durationFormatted = gmdate("H:i:s", $durationInSeconds);

        $hasilTes = HasilTes::where('pelatihan_id', $pelatihan_id)
                    ->where('karyawan_id', $karyawan->id)
                    ->first();

        if (!$hasilTes) {
            $hasilTes = HasilTes::create([
                'pelatihan_id' => $pelatihan_id,
                'karyawan_id'  => $karyawan->id,
                'jumlah_benar' => $jumlah_benar,
                'jumlah_salah' => $jumlah_soal_current - $jumlah_benar,
                'status'       => ($jumlah_soal_current > 0 && (($jumlah_benar / $jumlah_soal_current) * 100) >= 75) ? 'kompeten' : 'tidak kompeten',
                'tes_selesai'  => false,
                'durasi_tes'   => $durationFormatted,
            ]);
        } else {
            $new_jumlah_benar = $hasilTes->jumlah_benar + $jumlah_benar;
            $new_jumlah_salah = $hasilTes->jumlah_salah + ($jumlah_soal_current - $jumlah_benar);
            $new_status = (($new_jumlah_benar / ($new_jumlah_benar + $new_jumlah_salah)) * 100) >= 75 ? 'kompeten' : 'tidak kompeten';

            $hasilTes->update([
                'jumlah_benar' => $new_jumlah_benar,
                'jumlah_salah' => $new_jumlah_salah,
                'status'       => $new_status,
                'durasi_tes'   => $durationFormatted,
            ]);
        }

        session()->forget('subtes_start_time');

        $progress = \App\Models\PelatihanProgress::updateOrCreate(
            ['pelatihan_id' => $pelatihan_id, 'karyawan_id' => $karyawan->id],
            ['sub_tes_index' => $sub_tes_index + 1]
        );

        if ($sub_tes_index + 1 < $subtesList->count()) {
            session()->put('subtes_start_time', Carbon::now()->toDateTimeString());
            return redirect()->route('pelatihan.mulai', [$pelatihan_id, $sub_tes_index + 1])
                ->with('success', "Sub Tes " . ($sub_tes_index + 1) . " selesai.");
        } else {
            $hasilTes->update(['tes_selesai' => true]);
            $progress->delete();
            return redirect()->route('pelatihan.hasil', $pelatihan_id)
                ->with('success', "Semua Sub Tes telah selesai.");
        }
    }

    public function hasil($pelatihan_id)
    {
        $pelatihan = Pelatihan::with('subtes.soal')->findOrFail($pelatihan_id);
        $hasil = HasilTes::where('pelatihan_id', $pelatihan_id)
                    ->where('karyawan_id', Auth::user()->id)
                    ->first();

        // Hitung total soal secara dinamis dari seluruh subtes
        $total_soal = $pelatihan->subtes->sum(function($subtes) {
            return $subtes->soal->count();
        });

        return view('tes.hasil', compact('pelatihan', 'hasil', 'total_soal'));
    }

    public function finishTest($pelatihan_id)
    {
        $karyawan = Auth::user();
        $hasilTes = HasilTes::where('pelatihan_id', $pelatihan_id)
                    ->where('karyawan_id', $karyawan->id)
                    ->first();

        if (!$hasilTes) {
            return response()->json([
                'success' => false,
                'message' => 'Data hasil tes tidak ditemukan.'
            ], 404);
        }

        $pelatihan = Pelatihan::find($pelatihan_id);
        $waktu_habis = Carbon::parse($pelatihan->tanggal_pelatihan . ' ' . $pelatihan->waktu_selesai);
        $now = Carbon::now();

        if ($now->greaterThanOrEqualTo($waktu_habis)) {
            $hasilTes->update(['tes_selesai' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Status tes diperbarui menjadi selesai karena waktu habis.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tes masih dapat diakses, belum mencapai batas waktu.'
        ]);
    }
}
