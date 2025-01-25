<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LoginController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\KaryawanController::class, 'tampil'])->name('admin.tampil');
    Route::get('/admin/tambah', [App\Http\Controllers\KaryawanController::class, 'tambah'])->name('admin.tambah');
    Route::post('/admin/submit', [App\Http\Controllers\KaryawanController::class, 'submit'])->name('admin.submit');
    Route::get('/admin/edit/{id}', [App\Http\Controllers\KaryawanController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [App\Http\Controllers\KaryawanController::class, 'update'])->name('admin.update');
    Route::post('/admin/delete/{id}', [App\Http\Controllers\KaryawanController::class, 'delete'])->name('admin.delete');
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');
    Route::post('/absen', [AbsenController::class, 'store'])->name('absen.store');
    Route::post('/absen/pulang', [AbsenController::class, 'pulang'])->name('absen.pulang');
    Route::post('/absen/izin', [AbsenController::class, 'izin'])->name('absen.izin');
});
