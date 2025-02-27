<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Posisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function tampil()
    {
        $karyawan = Karyawan::with('posisi')->get();
        return view('admin.tampil', compact('karyawan'));
    }

    public function tambah()
    {
        $posisi = Posisi::all();
        return view('admin.tambah', compact('posisi'));
    }

    public function submit(Request $request) // sebelumnya submit() sebagai store()
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'email'        => 'required|email|unique:karyawan,email',
            'password'     => 'required|min:6',
            'role'         => 'required|in:admin,karyawan',
            'id_posisi'    => 'nullable|exists:posisi,id',
            'tipe_karyawan'=> 'required|in:tetap,kontrak,magang'
        ]);

        $validated['password'] = Hash::make($request->password);

        Karyawan::create($validated);

        return redirect()->route('admin.tampil')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $posisi = Posisi::all();
        return view('admin.edit', compact('karyawan', 'posisi'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'email'        => 'required|email|unique:karyawan,email,' . $id,
            'password'     => 'nullable|min:6',
            'role'         => 'required|in:admin,karyawan',
            'id_posisi'    => 'nullable|exists:posisi,id',
            'tipe_karyawan'=> 'required|in:tetap,kontrak,magang'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $karyawan->update($validated);

        return redirect()->route('admin.tampil')->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function delete($id) // sebelumnya delete() sebagai destroy()
    {
        Karyawan::destroy($id);
        return redirect()->route('admin.tampil')->with('success', 'Data karyawan berhasil dihapus');
    }

    /* --- Fungsi Edit Profil untuk User (Karyawan) --- */

    // Menampilkan form edit profil untuk karyawan (bisa digunakan oleh kedua role jika diperlukan)
    public function editProfile()
    {
        $karyawan = Auth::user();
        return view('users.edit-profile', compact('karyawan'));
    }

    // Memproses update profil (termasuk foto profil)
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:karyawan,email,' . Auth::id(),
            'password'      => 'nullable|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
    
        // Jika tidak mengisi password, hapus key 'password' dari data yang akan diupdate
        if (!$request->filled('password')) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($request->password);
        }
    
        // Jika ada file gambar, proses upload dan tambahkan ke data validasi
        if ($request->hasFile('profile_image')) {
            $karyawan = Auth::user();
            if ($karyawan->profile_image && file_exists(storage_path('app/public/profile/' . $karyawan->profile_image))) {
                unlink(storage_path('app/public/profile/' . $karyawan->profile_image));
            }
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Gunakan disk 'public' secara eksplisit agar file tersimpan di storage/app/public/profile
            $file->storeAs('profile', $filename, 'public');
            $validated['profile_image'] = $filename;
        }
    
        /** @var \App\Models\Karyawan $karyawan */
        $karyawan = Auth::user();
        $karyawan->update($validated);
    
        return redirect()->route('absen.index')->with('success', 'Profil berhasil diperbarui.');
    }
    

}
