<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Karyawan;
use App\Models\PelatihanRequest;
use App\Models\Posisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelatihanController extends Controller
{
    // Menampilkan daftar pelatihan sesuai dengan posisi karyawan
    public function index()
{
    $user = Auth::user();
    
    // Asumsikan Anda memiliki cara untuk cek apakah user adalah admin
    if ($user->role === 'admin') {
        $pelatihan = Pelatihan::all();
    } else {
        $karyawan = Karyawan::where('user_id', $user->id)->first();
        $pelatihan = Pelatihan::whereHas('posisis', function($query) use ($karyawan) {
            $query->where('posisi_id', $karyawan->posisi_id);
        })->get();
    }

    return view('pelatihan.index', compact('pelatihan'));
}

    // Menampilkan form untuk membuat pelatihan baru
    public function create()
    {
        // Mengambil semua data posisi untuk ditampilkan sebagai checkbox di form
        $posisi = Posisi::all();
        return view('pelatihan.create', compact('posisi'));
    }

    // Menyimpan data pelatihan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelatihan'      => 'required|string|max:255',
            'tanggal_pendaftaran' => 'required|date',
            'tanggal_pelatihan'   => 'required|date',
            'waktu_mulai'         => 'required|date_format:H:i:s',
            'waktu_akhir'         => 'required|date_format:H:i:s',
            'alamat'              => 'required|string|max:255',
            'deskripsi'           => 'required|string',
            'posisi_ids'          => 'required|array'
        ]);

        // Simpan data pelatihan
        $pelatihan = Pelatihan::create([
            'nama_pelatihan'      => $request->nama_pelatihan,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'tanggal_pelatihan'   => $request->tanggal_pelatihan,
            'waktu_mulai'         => $request->waktu_mulai,
            'waktu_akhir'         => $request->waktu_akhir,
            'alamat'              => $request->alamat,
            'deskripsi'           => $request->deskripsi,
        ]);

        // Simpan relasi many-to-many ke posisi melalui pivot table
        $pelatihan->posisis()->attach($request->posisi_ids);

        return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil disimpan.');
    }

    // Menampilkan detail pelatihan
    public function show($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        return view('pelatihan.show', compact('pelatihan'));
    }

    // Karyawan mengajukan request untuk mengikuti pelatihan
    public function requestJoin($id)
    {
        $user = Auth::user();
        $karyawan = Karyawan::where('id', $user->id)->first();

        // Periksa apakah karyawan sudah mengajukan request untuk pelatihan ini
        $existingRequest = PelatihanRequest::where('pelatihan_id', $id)
            ->where('karyawan_id', $karyawan->id)
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan permintaan untuk pelatihan ini.');
        }

        PelatihanRequest::create([
            'pelatihan_id' => $id,
            'karyawan_id'  => $karyawan->id,
            'status'       => 'pending'
        ]);

        return redirect()->back()->with('success', 'Permintaan pelatihan telah dikirim.');
    }

    // Menampilkan form edit pelatihan
    public function edit($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        // Ambil semua posisi untuk checkbox
        $posisi = Posisi::all();
        // Ambil array ID posisi yang sudah ter-relasi dengan pelatihan
        $selectedPosisi = $pelatihan->posisis()->pluck('id')->toArray();
        return view('pelatihan.edit', compact('pelatihan', 'posisi', 'selectedPosisi'));
    }

    // Memperbarui data pelatihan
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_pelatihan'      => 'required|string|max:255',
        'tanggal_pendaftaran' => 'required|date',
        'tanggal_pelatihan'   => 'required|date',
        'waktu_mulai'         => 'required|date_format:H:i:s',
        'waktu_akhir'         => 'required|date_format:H:i:s',
        'alamat'              => 'required|string|max:255',
        'deskripsi'           => 'required|string',
        'posisi_ids'          => 'required|array'
    ]);

    $pelatihan = Pelatihan::findOrFail($id);
    $pelatihan->update([
        'nama_pelatihan'      => $request->nama_pelatihan,
        'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        'tanggal_pelatihan'   => $request->tanggal_pelatihan,
        'waktu_mulai'         => $request->waktu_mulai,
        'waktu_akhir'         => $request->waktu_akhir,
        'alamat'              => $request->alamat,
        'deskripsi'           => $request->deskripsi,
    ]);

    // Update relasi many-to-many menggunakan sync
    $pelatihan->posisis()->sync($request->posisi_ids);

    return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil diperbarui.');
}

     // (Opsional) Hapus pelatihan
    public function destroy($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->delete();
        return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil dihapus.');
    }

}
