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


    // Menghapus data hasil tes
    public function destroy($id)
    {
        $hasilTes = HasilTes::findOrFail($id);
        $hasilTes->delete();

        return redirect()->route('hasiltes.index')->with('success', 'Data hasil tes berhasil dihapus.');
    }
}
