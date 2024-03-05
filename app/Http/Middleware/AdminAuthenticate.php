<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }
        abort(403, 'YOU DO NOT HAVE ACCESS TO THIS SITE.');
    }
}
