<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataAbsenController extends Controller
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

        return redirect()->route('absen.admin.index')->with('success', 'Absensi berhasil ditambahkan!');
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

        return redirect()->route('absen.admin.index')->with('success', 'Absensi berhasil diperbarui!');
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

        return redirect()->route('absen.admin.index')->with('success', 'Absensi berhasil dihapus!');
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

   
}