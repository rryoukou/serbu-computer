<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kalau belum login → 404
        if (!Auth::check()) {
            abort(404);
        }

        // Kalau login tapi bukan admin → 404
        if (Auth::user()->role !== 'admin') {
            abort(404);
        }

        return $next($request);
    }
}