<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Jika user belum login, alihkan ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Jika user memiliki role yang sesuai, lanjutkan request
        if ($user->role === $role) {
            return $next($request);
        }

        // Jika user tidak memiliki akses, hanya redirect jika belum di halaman tujuan
        return $this->safeRedirect($user);
    }

    /**
     * Cegah redirect looping dengan memeriksa apakah user sudah di halaman tujuan.
     */
    protected function safeRedirect($user)
{
    $redirectUrl = match ($user->role) {
        'admin' => '/admin/dashboard',
        'karyawan' => '/absen',
        default => '/login', // Pastikan ini adalah fallback yang aman
    };

    // Normalisasi URL untuk memastikan perbandingan yang akurat
    $currentUrl = rtrim(request()->url(), '/');
    $targetUrl = rtrim(url($redirectUrl), '/');

    // Hindari redirect jika user sudah ada di halaman tujuan
    if ($currentUrl === $targetUrl) {
        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }

    return redirect($redirectUrl);
}
}
