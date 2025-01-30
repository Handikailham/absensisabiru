<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    // Menampilkan daftar absensi
    public function index()
    {
        $karyawan = Auth::user();
        $absenHariIni = Absen::where('karyawan_id', $karyawan->id)
                            ->whereDate('tanggal', now()->toDateString())
                            ->first();

        return view('absen.index', compact('karyawan', 'absenHariIni'));
    }

    // Absen masuk dengan validasi jam masuk
    public function absenMasuk(Request $request)
    {
        $karyawan = Auth::user();
        $jamMasuk = now()->toTimeString();
        $jamMulaiAbsen = '10:00:00';
        
        $absenHariIni = Absen::where('karyawan_id', $karyawan->id)
                             ->whereDate('tanggal', now()->toDateString())
                             ->exists();

        if ($absenHariIni) {
            return redirect()->route('absen.index')->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        if (strtotime($jamMasuk) < strtotime($jamMulaiAbsen)) {
            return redirect()->route('absen.index')->with('error', 'Anda belum bisa melakukan absen sebelum pukul ' . $jamMulaiAbsen);
        }

        $status = strtotime($jamMasuk) > strtotime('12:00:00') ? 'terlambat' : 'hadir';

        Absen::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => $jamMasuk,
            'status' => $status,
        ]);

        return redirect()->route('absen.index')->with('success', 'Absen masuk berhasil dilakukan!');
    }

    // Absen pulang dengan validasi jam keluar
    public function absenPulang(Request $request)
    {
        $karyawan = Auth::user();
        $jamPulang = now()->toTimeString();
        $jamMulaiPulang = '13:30:00';

        if (strtotime($jamPulang) < strtotime($jamMulaiPulang)) {
            return redirect()->route('absen.index')->with('error', 'Anda belum bisa melakukan absen pulang sebelum pukul ' . $jamMulaiPulang);
        }

        $absen = Absen::where('karyawan_id', $karyawan->id)
                      ->whereDate('tanggal', now()->toDateString())
                      ->first();

        if ($absen) {
            $absen->update([
                'jam_pulang' => $jamPulang,
            ]);

            return redirect()->route('absen.index')->with('success', 'Absen pulang berhasil dilakukan!');
        }

        return redirect()->route('absen.index')->with('error', 'Anda belum melakukan absen masuk!');
    }

    // Ajukan izin dengan validasi
    public function izin(Request $request)
    {
        $karyawan = Auth::user();
        $absenHariIni = Absen::where('karyawan_id', $karyawan->id)
                             ->whereDate('tanggal', now()->toDateString())
                             ->exists();

        if ($absenHariIni) {
            return redirect()->route('absen.index')->with('error', 'Anda sudah melakukan absen atau izin hari ini.');
        }

        Absen::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => now()->toDateString(),
            'status' => 'izin',
        ]);

        return redirect()->route('absen.index')->with('success', 'Permohonan izin berhasil dicatat!');
    }
}
