<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


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

        $status = strtotime($jamMasuk) > strtotime('10:10:00') ? 'terlambat' : 'hadir';

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
        $jamMulaiPulang = '16:30:00';

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
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id', 
            'izin_mulai' => 'required|date',
            'izin_selesai' => 'required|date|after_or_equal:izin_mulai',
            'alasan' => 'required|string',
        ]);
    
        $tanggalMulai = \Carbon\Carbon::parse($request->izin_mulai);
        $tanggalSelesai = \Carbon\Carbon::parse($request->izin_selesai);
        $firstIzin = null; // Menyimpan izin pertama untuk redirect
    
        while ($tanggalMulai->lte($tanggalSelesai)) {
            $izin = Absen::create([
                'karyawan_id' => $request->karyawan_id,
                'tanggal' => $tanggalMulai->toDateString(),
                'status' => 'izin',
                'alasan' => $request->alasan,
            ]);
    
            if (!$firstIzin) {
                $firstIzin = $izin; // Simpan izin pertama untuk redirect
            }
    
            $tanggalMulai->addDay(); // Tambah 1 hari untuk iterasi berikutnya
        }
    
        return redirect()->route('absen.keterangan', $firstIzin->id)->with('success', 'Izin berhasil diajukan!');
    }
    

    public function downloadIzinPDF($id)
{
    // Ambil data izin berdasarkan ID
    $izin = Absen::where('karyawan_id', Auth::id())->where('id', $id)->firstOrFail();
    
    // Ambil semua izin dalam rentang tanggal yang sama
    $izins = Absen::where('karyawan_id', $izin->karyawan_id)
                ->whereBetween('tanggal', [$izin->tanggal, Absen::where('karyawan_id', $izin->karyawan_id)
                ->where('status', 'izin')
                ->max('tanggal')])
                ->get();

    // Ubah format tanggal menjadi d-m-Y untuk setiap izin
    foreach ($izins as $izin) {
        $izin->tanggal = \Carbon\Carbon::parse($izin->tanggal)->format('d-m-Y');
    }

    // Load tampilan PDF dengan data izins
    $pdf = PDF::loadView('absen.izin_pdf', compact('izins'));
    return $pdf->download('Surat Permohonan Izin.pdf');
}

    

public function formIzin()
{
    return view('absen.izin');
}

public function keteranganIzin($id)
{
    $izin = Absen::findOrFail($id);

    // Ambil semua izin dalam rentang tanggal yang sama
    $izins = Absen::where('karyawan_id', $izin->karyawan_id)
            ->whereBetween('tanggal', [$izin->tanggal, Absen::where('karyawan_id', $izin->karyawan_id)
            ->where('status', 'izin')
            ->max('tanggal')])
            ->get();

    // Ubah format tanggal menjadi d-m-Y untuk setiap izin
    foreach ($izins as $izin) {
        $izin->tanggal = \Carbon\Carbon::parse($izin->tanggal)->format('d-m-Y');
    }

    return view('absen.keterangan', compact('izins'));
}




    
}
