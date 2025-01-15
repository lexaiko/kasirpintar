<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Periksa apakah user memiliki salah satu role yang diperbolehkan
        if (!in_array($request->user()->roles, $roles)) {
            return redirect('dashboard')->with('error', 'Anda tidak memiliki akses!');
        }

        return $next($request);
    }
}
