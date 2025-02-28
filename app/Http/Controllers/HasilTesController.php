<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use App\Models\Pelatihan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class HasilTesController extends Controller
{
    // Menampilkan daftar hasil tes
    public function index()
    {
        // Ambil data hasil tes beserta relasi pelatihan dan karyawan
        $hasilTes = HasilTes::with(['pelatihan', 'karyawan'])->get();
        return view('hasiltes.index', compact('hasilTes'));
    }

    // Menampilkan form untuk membuat hasil tes baru
    public function create()
    {
        $pelatihans = Pelatihan::all();
        $karyawans = Karyawan::all();
        return view('hasiltes.create', compact('pelatihans', 'karyawans'));
    }

    // Menyimpan hasil tes baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelatihan_id' => 'required|exists:pelatihan,id',
            'karyawan_id'  => 'required|exists:karyawan,id',
            'total_soal'   => 'required|integer|min:0',
            'jumlah_benar' => 'required|integer|min:0',
            'jumlah_salah' => 'required|integer|min:0',
            'status'       => 'required|string',
            'tes_selesai'  => 'required|boolean',
        ]);

        HasilTes::create($validated);

        return redirect()->route('hasiltes.index')->with('success', 'Data hasil tes berhasil disimpan.');
    }

    // Menampilkan detail hasil tes
    public function show($id)
    {
        $hasilTes = HasilTes::with(['pelatihan', 'karyawan'])->findOrFail($id);
        return view('hasiltes.show', compact('hasilTes'));
    }

    // Menampilkan form edit hasil tes
    public function edit($id)
    {
        $hasilTes = HasilTes::findOrFail($id);
        $pelatihans = Pelatihan::all();
        $karyawans = Karyawan::all();
        return view('hasiltes.edit', compact('hasilTes', 'pelatihans', 'karyawans'));
    }

    // Memperbarui data hasil tes
    public function update(Request $request, $id)
    {
        $hasilTes = HasilTes::findOrFail($id);

        $validated = $request->validate([
            'pelatihan_id' => 'required|exists:pelatihan,id',
            'karyawan_id'  => 'required|exists:karyawan,id',
            'total_soal'   => 'required|integer|min:0',
            'jumlah_benar' => 'required|integer|min:0',
            'jumlah_salah' => 'required|integer|min:0',
            'status'       => 'required|string',
            'tes_selesai'  => 'required|boolean',
        ]);

        $hasilTes->update($validated);

        return redirect()->route('hasiltes.index')->with('success', 'Data hasil tes berhasil diperbarui.');
    }

    // Menghapus data hasil tes
    public function destroy($id)
    {
        $hasilTes = HasilTes::findOrFail($id);
        $hasilTes->delete();

        return redirect()->route('hasiltes.index')->with('success', 'Data hasil tes berhasil dihapus.');
    }
}
