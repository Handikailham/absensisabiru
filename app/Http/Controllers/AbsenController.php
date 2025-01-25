<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index()
    {
        $karyawan = Auth::user();
        $absenHariIni = Absen::where('karyawan_id', $karyawan->id)
                            ->whereDate('tanggal', now()->toDateString())
                            ->first();

        return view('absen.index', compact('karyawan', 'absenHariIni'));
    }

    public function store(Request $request)
    {
        $karyawan = Auth::user();
        $jamMasuk = now()->toTimeString();
        $status = strtotime($jamMasuk) > strtotime('12:00:00') ? 'terlambat' : 'hadir';

        Absen::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => $jamMasuk,
            'status' => $status,
        ]);

        return redirect()->route('absen.index')->with('success', 'Absen berhasil dilakukan!');
    }

    public function pulang(Request $request)
    {
        $karyawan = Auth::user();
        $absen = Absen::where('karyawan_id', $karyawan->id)
                      ->whereDate('tanggal', now()->toDateString())
                      ->first();

        if ($absen) {
            $absen->update([
                'jam_pulang' => now()->toTimeString(),
            ]);

            return redirect()->route('absen.index')->with('success', 'Absen pulang berhasil dilakukan!');
        }

        return redirect()->route('absen.index')->with('error', 'Anda belum melakukan absen masuk!');
    }

    public function izin(Request $request)
    {
        $karyawan = Auth::user();

        Absen::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => now()->toDateString(),
            'status' => 'izin',
        ]);

        return redirect()->route('absen.index')->with('success', 'Permohonan izin berhasil dicatat!');
    }
}
