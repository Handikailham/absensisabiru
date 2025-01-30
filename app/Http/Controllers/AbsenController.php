<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    // Menampilkan daftar absensi (untuk admin)
    public function index(Request $request)
{
    // Hanya admin yang bisa mengakses
    if (Auth::user()->role !== 'admin') {
        return redirect()->route('absen.index')->with('error', 'Anda tidak memiliki akses!');
    }

    // Ambil tanggal dari request (jika ada)
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Query untuk filtering berdasarkan tanggal (jika ada)
    $absens = Absen::with('karyawan')
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('tanggal', [$startDate, $endDate]);
        })
        ->latest()
        ->get();

    // Kirim data ke view
    return view('absen.admin.index', compact('absens', 'startDate', 'endDate'));
}

    // Menampilkan form tambah absensi (untuk admin)
    public function create()
    {
        // Hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('absen.index')->with('error', 'Anda tidak memiliki akses!');
        }

        $karyawans = Karyawan::all();
        return view('absen.admin.create', compact('karyawans'));
    }

    // Menyimpan data absensi baru (untuk admin)
    public function store(Request $request)
    {
        // Hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('absen.index')->with('error', 'Anda tidak memiliki akses!');
        }

        // Validasi input
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_pulang' => 'nullable|date_format:H:i',
            'status' => 'required|in:hadir,terlambat,izin',
        ]);

        // Simpan data absensi
        Absen::create($request->all());

        return redirect()->route('absen.index')->with('success', 'Absensi berhasil ditambahkan!');
    }

    // Menampilkan detail absensi (untuk admin)
    public function show($id)
    {
        // Hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('absen.index')->with('error', 'Anda tidak memiliki akses!');
        }

        $absen = Absen::with('karyawan')->findOrFail($id);
        return view('absen.admin.show', compact('absen'));
    }

    // Menampilkan form edit absensi (untuk admin)
    public function edit($id)
    {
        // Hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('absen.index')->with('error', 'Anda tidak memiliki akses!');
        }

        $absen = Absen::findOrFail($id);
        $karyawans = Karyawan::all();
        return view('absen.admin.edit', compact('absen', 'karyawans'));
    }

    // Mengupdate data absensi (untuk admin)
    public function update(Request $request, $id)
    {
        // Hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('absen.index')->with('error', 'Anda tidak memiliki akses!');
        }

        // Validasi input
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tanggal' => 'required|date',
            
            'status' => 'required|in:hadir,terlambat,izin',
        ]);

        // Update data absensi
        $absen = Absen::findOrFail($id);
        $absen->update($request->all());

        return redirect()->route('absen.index')->with('success', 'Absensi berhasil diperbarui!');
    }

    // Menghapus data absensi (untuk admin)
    public function destroy($id)
    {
        // Hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('absen.index')->with('error', 'Anda tidak memiliki akses!');
        }

        // Hapus data absensi
        $absen = Absen::findOrFail($id);
        $absen->delete();

        return redirect()->route('absen.index')->with('success', 'Absensi berhasil dihapus!');
    }

    // Metode untuk karyawan melakukan absen masuk
    public function absenMasuk(Request $request)
    {
        $karyawan = Auth::user();
        $jamMasuk = now()->toTimeString();
        $jamMulaiAbsen = '10:00:00'; // Jam mulai absen masuk

        // Cek apakah karyawan sudah melakukan absen masuk hari ini
        $absenHariIni = Absen::where('karyawan_id', $karyawan->id)
                             ->whereDate('tanggal', now()->toDateString())
                             ->exists();

        if ($absenHariIni) {
            return redirect()->route('absen.index')->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        // Validasi jika karyawan mencoba absen sebelum jam yang ditentukan
        if (strtotime($jamMasuk) < strtotime($jamMulaiAbsen)) {
            return redirect()->route('absen.index')->with('error', 'Anda belum bisa melakukan absen masuk sebelum pukul ' . $jamMulaiAbsen);
        }

        // Tentukan status berdasarkan jam masuk
        $status = strtotime($jamMasuk) > strtotime('12:00:00') ? 'terlambat' : 'hadir';

        // Simpan data absen
        Absen::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => $jamMasuk,
            'status' => $status,
        ]);

        return redirect()->route('absen.index')->with('success', 'Absen berhasil dilakukan!');
    }

    // Metode untuk karyawan melakukan absen pulang
    public function absenPulang(Request $request)
    {
        $karyawan = Auth::user();
        $jamPulang = now()->toTimeString();
        $jamMulaiPulang = '17:30:00'; // Jam mulai absen pulang

        // Validasi jika karyawan mencoba absen pulang sebelum jam yang ditentukan
        if (strtotime($jamPulang) < strtotime($jamMulaiPulang)) {
            return redirect()->route('absen.index')->with('error', 'Anda belum bisa melakukan absen pulang sebelum pukul ' . $jamMulaiPulang);
        }

        // Cek apakah karyawan sudah melakukan absen masuk hari ini
        $absen = Absen::where('karyawan_id', $karyawan->id)
                      ->whereDate('tanggal', now()->toDateString())
                      ->first();

        if ($absen) {
            // Update jam pulang
            $absen->update([
                'jam_pulang' => $jamPulang,
            ]);

            return redirect()->route('absen.index')->with('success', 'Absen pulang berhasil dilakukan!');
        }

        return redirect()->route('absen.index')->with('error', 'Anda belum melakukan absen masuk!');
    }

    public function filterByDate(Request $request)
{
    // Hanya admin yang bisa mengakses
    if (Auth::user()->role !== 'admin') {
        return redirect()->route('absen.index')->with('error', 'Anda tidak memiliki akses!');
    }

    // Validasi input tanggal
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Ambil tanggal dari request
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Query untuk filtering berdasarkan tanggal
    $absens = Absen::with('karyawan')
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->latest()
        ->get();

    // Kirim data ke view
    return view('absen.admin.index', compact('absens', 'startDate', 'endDate'));
}

    // Metode untuk karyawan mengajukan izin
    public function izin(Request $request)
    {
        $karyawan = Auth::user();

        // Cek apakah karyawan sudah melakukan absen atau izin hari ini
        $absenHariIni = Absen::where('karyawan_id', $karyawan->id)
                             ->whereDate('tanggal', now()->toDateString())
                             ->exists();

        if ($absenHariIni) {
            return redirect()->route('absen.index')->with('error', 'Anda sudah melakukan absen atau izin hari ini.');
        }

        // Simpan data izin
        Absen::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => now()->toDateString(),
            'status' => 'izin',
        ]);

        return redirect()->route('absen.index')->with('success', 'Permohonan izin berhasil dicatat!');
    }
}