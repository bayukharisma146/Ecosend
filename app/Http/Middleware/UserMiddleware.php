<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Harus login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'user') {
            return redirect('/login')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
