<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DataAbsenController;

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
        Route::get('/{id}', [DataAbsenController::class, 'show'])->name('absen.admin.show');
        Route::get('/edit/{id}', [DataAbsenController::class, 'edit'])->name('absen.admin.edit');
        Route::put('/update/{id}', [DataAbsenController::class, 'update'])->name('absen.admin.update');
        Route::delete('/delete/{id}', [DataAbsenController::class, 'destroy'])->name('absen.admin.destroy');
    });
});

// Route untuk karyawan (hanya perlu autentikasi)
Route::middleware(['auth', CheckRole::class . ':karyawan'])->group(function () {
    Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');
    Route::post('/absen/masuk', [AbsenController::class, 'absenMasuk'])->name('absen.masuk');
    Route::post('/absen/pulang', [AbsenController::class, 'absenPulang'])->name('absen.pulang');
    Route::post('/absen/izin', [AbsenController::class, 'izin'])->name('absen.izin');
});
