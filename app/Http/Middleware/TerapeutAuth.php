<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TerapeutAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if terapeut is logged in
        if (!session()->has('terapeut_id')) {
            return redirect('/')->withErrors(['login' => 'Please log in as terapeut to access this page.']);
        }

        return $next($request);
    }
}