<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $level)
    {
        if ($request->user() && $request->user()->level === $level) {
            return $next($request);
        }

        return redirect('/'); // Redirect ke halaman beranda atau halaman lain jika level tidak sesuai
    }
}
