<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Subtes;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    // Menampilkan daftar soal
    public function index()
    {
        $soals = Soal::with('subtes.pelatihan')->get();
        return view('soal.index', compact('soals'));
    }

    // Menampilkan form tambah soal
    public function create()
    {
        $subtes = Subtes::all();
        return view('soal.create', compact('subtes'));
    }

    // Menyimpan soal baru
    public function store(Request $request)
    {
        $request->validate([
            'sub_tes_id'    => 'required|exists:subtes,id',
            'pertanyaan'    => 'required|string',
            'pilihan_a'     => 'required|string',
            'pilihan_b'     => 'required|string',
            'pilihan_c'     => 'required|string',
            'pilihan_d'     => 'required|string',
            'jawaban_benar' => 'required|string|in:a,b,c,d', // atau sesuai aturan Anda
        ]);

        Soal::create($request->all());

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan.');
    }

    // Menampilkan detail soal (opsional)
    public function show($id)
    {
        $soal = Soal::with('subtes')->findOrFail($id);
        return view('soal.show', compact('soal'));
    }

    // Menampilkan form edit soal
    public function edit($id)
    {
        $soal = Soal::findOrFail($id);
        $subtes = Subtes::all();
        return view('soal.edit', compact('soal', 'subtes'));
    }

    // Memperbarui data soal
    public function update(Request $request, $id)
    {
        $request->validate([
            'sub_tes_id'    => 'required|exists:subtes,id',
            'pertanyaan'    => 'required|string',
            'pilihan_a'     => 'required|string',
            'pilihan_b'     => 'required|string',
            'pilihan_c'     => 'required|string',
            'pilihan_d'     => 'required|string',
            'jawaban_benar' => 'required|string|in:a,b,c,d',
        ]);

        $soal = Soal::findOrFail($id);
        $soal->update($request->all());

        return redirect()->route('soal.index')->with('success', 'Soal berhasil diperbarui.');
    }

    // Menghapus soal
    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus.');
    }
}
