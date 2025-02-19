<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Posisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawan,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,karyawan',
            'id_posisi' => 'nullable|exists:posisi,id',
            'tipe_karyawan' => 'required|in:tetap,kontrak,magang'
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
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawan,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,karyawan',
            'id_posisi' => 'nullable|exists:posisi,id',
            'tipe_karyawan' => 'required|in:tetap,kontrak,magang'
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
}
