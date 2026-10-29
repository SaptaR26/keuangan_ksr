<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckKsrAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika tidak memiliki sesi login KSR, paksa tendang ke halaman login
        if (!session()->has('login_ksr')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }
        
        return $next($request);
    }
}
