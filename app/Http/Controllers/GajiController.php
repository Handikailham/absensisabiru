<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class GajiController extends Controller
{
    public function index() {
        $gaji = Gaji::with(['karyawan', 'posisi'])->get();
        return view('gaji.index', compact('gaji'));
    }

    public function create() {
        $karyawan = Karyawan::with('posisi')->get();
        return view('gaji.create', compact('karyawan'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan'    => 'required|exists:karyawan,id',
            'gaji_pokok'     => 'required|numeric',
            'tunjangan'      => 'required|numeric',
            'lembur'         => 'required|numeric',
            'bonus'          => 'required|numeric',
            'total_gaji'     => 'required|numeric',
            'tanggal_gajian' => 'required|date',
        ]);
    
        $tanggalGajian = Carbon::parse($request->tanggal_gajian);
    
        $exists = Gaji::where('id_karyawan', $request->id_karyawan)
            ->whereYear('tanggal_gajian', $tanggalGajian->year)
            ->whereMonth('tanggal_gajian', $tanggalGajian->month)
            ->exists();
    
        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['id_karyawan' => 'Data gaji untuk karyawan ini pada bulan tersebut sudah ada.']);
        }
    
        $karyawan = Karyawan::find($request->id_karyawan);
        // Jika tipe karyawan adalah magang, gaji pokok diabaikan (diset ke 0)
        $gaji_pokok = ($karyawan->tipe_karyawan == 'magang') ? 0 : $request->gaji_pokok;
        $tunjangan = $request->tunjangan;
    
        // Recalculate total gaji (bisa juga diambil dari form, tapi lebih aman jika dihitung ulang)
        $total_gaji = $gaji_pokok + $tunjangan + $request->lembur + $request->bonus;
    
        Gaji::create([
            'id_karyawan'    => $request->id_karyawan,
            'id_posisi'      => $karyawan->id_posisi ?? null,
            'gaji_pokok'     => $gaji_pokok,
            'tunjangan'      => $tunjangan,
            'lembur'         => $request->lembur,
            'bonus'          => $request->bonus,
            'total_gaji'     => $total_gaji,
            'tanggal_gajian' => $request->tanggal_gajian,
        ]);
    
        return redirect()->route('gaji.index')->with('success', 'Data Gaji Berhasil Ditambahkan');
    }
    
    public function exportPdfOne($id)
    {
        // Ambil data gaji dengan relasi karyawan dan posisi
        $gaji = Gaji::with(['karyawan', 'posisi'])->findOrFail($id);

        // Load view PDF untuk data tunggal (buat file resources/views/gaji/pdf_single.blade.php)
        $pdf = Pdf::loadView('gaji.pdf_single', compact('gaji'));

        // Unduh PDF dengan nama file yang unik
        return $pdf->download(
            'Slip Gaji ' . $gaji->karyawan->nama . ' ' . Carbon::parse($gaji->tanggal_gajian)->format('d-m-Y') . '.pdf'
        );
        
    }

    public function riwayatForKaryawan()
    {
        // Ambil karyawan yang sedang login
        $karyawan = auth::user();

        // Ambil data gaji untuk karyawan yang login, urutkan berdasarkan tanggal gajian secara menurun
        $gajiRecords = Gaji::with('posisi')
            ->where('id_karyawan', $karyawan->id)
            ->orderBy('tanggal_gajian', 'desc')
            ->get();

        return view('absen.riwayat-gaji', compact('gajiRecords'));
    }
}
