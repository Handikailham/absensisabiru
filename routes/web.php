<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk dashboard
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Halaman Admin';
    });
});

Route::middleware(['auth', CheckRole::class . ':karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', function () {
        return 'Halaman Karyawan';
    });
});
