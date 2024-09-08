<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreIntendedUrlAndMessage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('login') && !$request->is('register') && !$request->is('password/*')) {
            $request->session()->put('url.intended', $request->url());
            $request->session()->flash('message', 'Please log in to access this page.');
        }

        return $next($request);
    }
}
