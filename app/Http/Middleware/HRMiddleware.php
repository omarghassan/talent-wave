<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HRMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            Auth::guard('admin')->check() &&
            (Auth::guard('admin')->user()->role == 'hr' || Auth::guard('admin')->user()->role == 'admin')
        ) {
            return $next($request);
        } else {
            abort(404);  // Redirect to the default 404 page
        }
    }
}
 
