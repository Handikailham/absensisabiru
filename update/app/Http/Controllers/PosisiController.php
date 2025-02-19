<?php

namespace App\Http\Controllers;

use App\Models\Posisi;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function index(){
        $posisi = Posisi::get();
        return view('posisi.tampil', compact('posisi'));
    }

    public function tambah(){
        return view('posisi.tambah');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_posisi' => 'required|unique:posisi,nama_posisi',
        'gaji_pokok' => 'required|numeric',
        'tunjangan' => 'required|numeric',
    ], [
        'nama_posisi.unique' => 'Posisi sudah ada!',
    ]);

    Posisi::create([
        'nama_posisi' => $request->nama_posisi,
        'gaji_pokok' => $request->gaji_pokok,
        'tunjangan' => $request->tunjangan,
    ]);

    return redirect()->route('posisi.index')->with('success', 'Posisi berhasil ditambahkan!');
}

public function edit($id)
{
    $posisi = Posisi::findOrFail($id);
    return view('posisi.edit', compact('posisi'));
}

/**
 * Mengupdate posisi di database.
 */
public function update(Request $request, $id)
{
    $posisi = Posisi::findOrFail($id);

    // Validasi input
    $request->validate([
        'nama_posisi' => 'required|unique:posisi,nama_posisi,' . $id,
        'gaji_pokok'  => 'required|numeric|min:0',
        'tunjangan'   => 'required|numeric|min:0',
    ], [
        'nama_posisi.unique' => 'Posisi sudah ada!',
    ]);

    // Update data
    $posisi->update([
        'nama_posisi' => $request->nama_posisi,
        'gaji_pokok'  => $request->gaji_pokok,
        'tunjangan'   => $request->tunjangan,
    ]);

    return redirect()->route('posisi.index')->with('success', 'Posisi berhasil diperbarui!');
}

public function destroy($id)
{
    // Cari posisi berdasarkan ID
    $posisi = Posisi::find($id);

    // Jika tidak ditemukan, beri pesan error
    if (!$posisi) {
        return redirect()->route('posisi.index')->with('error', 'Posisi tidak ditemukan.');
    }

    // Hapus data dari database
    $posisi->delete();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('posisi.index')->with('success', 'Posisi berhasil dihapus.');
}





    
}
