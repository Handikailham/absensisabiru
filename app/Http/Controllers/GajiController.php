<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GajiController extends Controller
{
    
        public function index() {
            $gaji = Gaji::with(['karyawan', 'posisi'])->get(); // Ambil data gaji dengan relasi
    
            return view('gaji.index', compact('gaji')); // Kirim ke view
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
        
            $tanggalGajian = \Carbon\Carbon::parse($request->tanggal_gajian);
        
            $exists = Gaji::where('id_karyawan', $request->id_karyawan)
                ->whereYear('tanggal_gajian', $tanggalGajian->year)
                ->whereMonth('tanggal_gajian', $tanggalGajian->month)
                ->exists();
        
            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['id_karyawan' => 'Data gaji untuk karyawan ini pada bulan tersebut sudah ada.']);
            }
        
            Gaji::create([
                'id_karyawan'    => $request->id_karyawan,
                'id_posisi'      => Karyawan::find($request->id_karyawan)->id_posisi ?? null,
                'lembur'         => $request->lembur,
                'bonus'          => $request->bonus,
                'total_gaji'     => $request->total_gaji,
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
        return $pdf->download('data-gaji_' . $gaji->id . '_' . Carbon::now()->format('YmdHis') . '.pdf');
    }






}

