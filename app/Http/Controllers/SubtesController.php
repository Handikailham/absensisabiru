<?php

namespace App\Http\Controllers;

use App\Models\Subtes;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class SubtesController extends Controller
{
    // Menampilkan daftar subtes
    public function index()
    {
        $subtes = Subtes::with('pelatihan')->orderBy('urutan')->get();
        return view('subtes.index', compact('subtes'));
    }

    // Menampilkan form untuk membuat subtes baru
    public function create()
    {
        $pelatihans = Pelatihan::all();
        return view('subtes.create', compact('pelatihans'));
    }

    // Menyimpan data subtes baru
    public function store(Request $request)
    {
        $request->validate([
            'pelatihan_id' => 'required|exists:pelatihan,id',
            'nama_subtes'  => 'required|string|max:255',
            'durasi'       => 'required|integer',
            'urutan'       => 'required|integer'
        ]);

        Subtes::create($request->all());

        return redirect()->route('subtes.index')->with('success', 'Subtes berhasil ditambahkan.');
    }

    // Menampilkan detail subtes (opsional)
    public function show($id)
    {
        $subtes = Subtes::with('pelatihan')->findOrFail($id);
        return view('subtes.show', compact('subtes'));
    }

    // Menampilkan form edit subtes
    public function edit($id)
    {
        $subtes = Subtes::findOrFail($id);
        $pelatihans = Pelatihan::all();
        return view('subtes.edit', compact('subtes', 'pelatihans'));
    }

    // Memperbarui data subtes
    public function update(Request $request, $id)
    {
        $request->validate([
            'pelatihan_id' => 'required|exists:pelatihan,id',
            'nama_subtes'  => 'required|string|max:255',
            'durasi'       => 'required|integer',
            'urutan'       => 'required|integer'
        ]);

        $subtes = Subtes::findOrFail($id);
        $subtes->update($request->all());

        return redirect()->route('subtes.index')->with('success', 'Subtes berhasil diperbarui.');
    }

    // Menghapus subtes
    public function destroy($id)
    {
        $subtes = Subtes::findOrFail($id);
        $subtes->delete();

        return redirect()->route('subtes.index')->with('success', 'Subtes berhasil dihapus.');
    }
}
