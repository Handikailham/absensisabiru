<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function tampil(){
        $karyawan = Karyawan::get();
        return view('admin.tampil', compact('karyawan'));
    }


    public function tambah(){
        return view('admin.tambah');
    }



    public function submit(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawan,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,karyawan',
        ]);
    
        // Simpan data ke database
        $karyawan = new Karyawan();
        $karyawan->nama = $request->nama;
        $karyawan->email = $request->email;
        $karyawan->password = bcrypt($request->password); // Simpan password yang sudah di-hash
        $karyawan->role = $request->role;
        $karyawan->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin.tampil')->with('success', 'Data karyawan berhasil ditambahkan!');
    }
    



    public function edit($id)
    {
        
        $karyawan = Karyawan::findOrFail($id);
    
        
        return view('admin.edit', compact('karyawan'));
    }
    
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawan,email,' . $id, 
            'password' => 'nullable|string|min:6', 
            'role' => 'required|string|in:admin,karyawan', 
        ]);
    
        
        $karyawan = Karyawan::findOrFail($id);
    
       
        $karyawan->nama = $request->nama;
        $karyawan->email = $request->email;
    
       
        if ($request->filled('password')) {
            $karyawan->password = bcrypt($request->password);
        }
    
        $karyawan->role = $request->role;
        $karyawan->save();
    
       
        return redirect()->route('admin.tampil')->with('success', 'Data karyawan berhasil diperbarui!');
    }
    





    public function delete($id){
        $project = Karyawan::find($id);
        $project->delete();
        return redirect()->route('admin.tampil'); 
    }


}
