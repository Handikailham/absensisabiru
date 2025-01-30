<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;

// Route untuk halaman welcome
Route::get('/', function () {
    return view('welcome');
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
        Route::get('/', [AbsenController::class, 'index'])->name('absen.admin.index');
        Route::get('/create', [AbsenController::class, 'create'])->name('absen.admin.create');
        Route::get('/filter', [AbsenController::class, 'filterByDate'])->name('absen.admin.filterByDate');
        Route::post('/store', [AbsenController::class, 'store'])->name('absen.admin.store');
        Route::get('/{id}', [AbsenController::class, 'show'])->name('absen.admin.show');
        Route::get('/edit/{id}', [AbsenController::class, 'edit'])->name('absen.admin.edit');
        Route::put('/update/{id}', [AbsenController::class, 'update'])->name('absen.admin.update');
        Route::delete('/delete/{id}', [AbsenController::class, 'destroy'])->name('absen.admin.destroy');
    });
});

// Route untuk karyawan (hanya perlu autentikasi)
Route::middleware(['auth'])->group(function () {
    // Route untuk absensi karyawan
    Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');
    Route::post('/absen', [AbsenController::class, 'store'])->name('absen.store');
    Route::post('/absen/pulang', [AbsenController::class, 'pulang'])->name('absen.pulang');
    Route::post('/absen/izin', [AbsenController::class, 'izin'])->name('absen.izin');
});