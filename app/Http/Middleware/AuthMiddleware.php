<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // cek apakah session logged_in ada 
        if (!session()->has('logged_in')) {
            return redirect('/login')->withErrors(['error' => 'silakan login terlebih dahulu']);
        }
        return $next($request);
    }
}
