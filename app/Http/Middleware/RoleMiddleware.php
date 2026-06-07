<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Cek apakah role user sesuai dengan yang diminta oleh route
        if (Auth::user()->role !== $role) {
            // Kalau bandel nembak URL, lempar error 403 (Forbidden)
            abort(403, 'Maaf Sil, akun kamu gak punya akses ke halaman ini!');
        }

        return $next($request);
    }
}