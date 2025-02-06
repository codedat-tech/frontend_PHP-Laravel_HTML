<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and if they are an admin
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'admin') {
            return $next($request);
        }
        abort(401);
    }
}
