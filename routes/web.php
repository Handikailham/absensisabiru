<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DataAbsenController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PelatihanRequestController;
use App\Http\Controllers\PelatihanKaryawanController;

// Route untuk halaman welcome
Route::get('/', function () {
    return view('auth.login');
});

// Route untuk login dan logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Route untuk admin (dengan middleware CheckRole)
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    // Route untuk dashboard admin

    // Route::prefix('/admin/dashboard')->group(function () {
    //     Route::get('/', [KaryawanController::class, 'tampil'])->name('admin.index');
    //     Route::get('/tambah', [KaryawanController::class, 'tambah'])->name('admin.tambah');
    //     Route::post('/submit', [KaryawanController::class, 'submit'])->name('admin.submit');
    //     Route::get('/edit/{id}', [KaryawanController::class, 'edit'])->name('admin.edit');
    //     Route::put('/update/{id}', [KaryawanController::class, 'update'])->name('admin.update');
    //     Route::post('/delete/{id}', [KaryawanController::class, 'delete'])->name('admin.delete');
    // });

    Route::get('/admin/dashboard', [KaryawanController::class, 'tampil'])->name('admin.tampil');

    // Route untuk manajemen karyawan
    Route::get('/admin/tambah', [KaryawanController::class, 'tambah'])->name('admin.tambah');
    Route::post('/admin/submit', [KaryawanController::class, 'submit'])->name('admin.submit');
    Route::get('/admin/edit/{id}', [KaryawanController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [KaryawanController::class, 'update'])->name('admin.update');
    Route::post('/admin/delete/{id}', [KaryawanController::class, 'delete'])->name('admin.delete');

    // Route untuk CRUD absensi (hanya admin yang bisa mengakses)
    Route::prefix('/admin/absensi')->group(function () {
        Route::get('/', [DataAbsenController::class, 'index'])->name('absen.admin.index');
        Route::get('/create', [DataAbsenController::class, 'create'])->name('absen.admin.create');
        Route::get('/filter', [DataAbsenController::class, 'filterByDate'])->name('absen.admin.filterByDate');
        Route::post('/store', [DataAbsenController::class, 'store'])->name('absen.admin.store');
        Route::get('/export', [DataAbsenController::class, 'export'])->name('absen.admin.export');
        Route::get('/{id}', [DataAbsenController::class, 'show'])->name('absen.admin.show');
        Route::get('/edit/{id}', [DataAbsenController::class, 'edit'])->name('absen.admin.edit');
        Route::put('/update/{id}', [DataAbsenController::class, 'update'])->name('absen.admin.update');
        Route::delete('/delete/{id}', [DataAbsenController::class, 'destroy'])->name('absen.admin.destroy');
        
       
    });

    Route::prefix('/admin/gaji')->group(function () {
        Route::get('/', [GajiController::class, 'index'])->name('gaji.index');
        Route::get('/tambah', [GajiController::class, 'create'])->name('gaji.create');
        Route::post('/store', [GajiController::class, 'store'])->name('gaji.store');
        Route::get('/gaji/export/{id}', [GajiController::class, 'exportPdfOne'])->name('gaji.export.one');
       
    });

    Route::prefix('/admin/posisi')->group(function () {
        Route::get('/', [PosisiController::class, 'index'])->name('posisi.index');
        Route::get('/tambah', [PosisiController::class, 'tambah'])->name('posisi.tambah');
        Route::get('/edit/{id}', [PosisiController::class, 'edit'])->name('posisi.edit');
        Route::put('/update/{id}', [PosisiController::class, 'update'])->name('posisi.update');
        Route::post('/store', [PosisiController::class, 'store'])->name('posisi.store');
        Route::delete('/delete/{id}', [PosisiController::class, 'destroy'])->name('posisi.destroy');
    });

    Route::prefix('admin/pelatihan')->group(function(){
        Route::get('/', [PelatihanController::class, 'index'])->name('pelatihan.index');
        Route::get('/create', [PelatihanController::class, 'create'])->name('pelatihan.create');
        Route::post('/store', [PelatihanController::class, 'store'])->name('pelatihan.store');
        Route::get('/{id}', [PelatihanController::class, 'show'])->name('pelatihan.show');
        Route::get('/{id}/edit', [PelatihanController::class, 'edit'])->name('pelatihan.edit');
        Route::put('/{id}', [PelatihanController::class, 'update'])->name('pelatihan.update');
        Route::delete('/{id}', [PelatihanController::class, 'destroy'])->name('pelatihan.delete');
    });

    Route::prefix('admin/pelatihanrequest')->group(function(){
        Route::get('/', [PelatihanRequestController::class, 'index'])->name('pelatihanrequest.index');
        Route::put('/{id}', [PelatihanRequestController::class, 'update'])->name('pelatihanrequest.update');
    });

    
});

// Route untuk karyawan (hanya perlu autentikasi)
Route::middleware(['auth', CheckRole::class . ':karyawan'])->group(function () {
    Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');
    Route::post('/absen/masuk', [AbsenController::class, 'absenMasuk'])->name('absen.masuk');
    Route::post('/absen/pulang', [AbsenController::class, 'absenPulang'])->name('absen.pulang');
    Route::get('/absen/izin', [AbsenController::class, 'formIzin'])->name('absen.form');
    Route::post('/absen/izin', [AbsenController::class, 'izin'])->name('absen.izin');
    
    Route::get('/pelatihan', [PelatihanKaryawanController::class, 'index'])->name('pelatihankaryawan.index');
    Route::get('/pelatihan/requested', [PelatihanKaryawanController::class, 'requested'])->name('pelatihankaryawan.requested');
    Route::get('/riwayat-gaji', [GajiController::class, 'riwayatForKaryawan'])->name('absen.riwayatgaji');
    Route::post('/join/{id}', [PelatihanKaryawanController::class, 'requestJoin'])->name('pelatihan.join');
    Route::get('/pelatihan/{pelatihan_id}/mulai/{sub_tes_index?}', [TesController::class, 'mulai'])
    ->name('pelatihan.mulai');

Route::post('/pelatihan/{pelatihan_id}/submit/{sub_tes_index}', [TesController::class, 'submitSubtes'])
    ->name('pelatihan.submit');

Route::get('/pelatihan/{pelatihan_id}/hasil', [TesController::class, 'hasil'])
    ->name('pelatihan.hasil');

    Route::get('/absen/izin/keterangan/{id}', [AbsenController::class, 'keteranganIzin'])->name('absen.keterangan');
    Route::get('/absen/izin/download/{id}', [AbsenController::class, 'downloadIzinPDF'])->name('absen.generatePDF');


});
