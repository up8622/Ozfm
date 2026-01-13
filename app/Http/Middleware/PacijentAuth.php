<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PacijentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if pacijent is logged in
        if (!session()->has('pacijent_id')) {
            return redirect('/')->withErrors(['login' => 'Please log in as pacijent to access this page.']);
        }

        return $next($request);
    }
}