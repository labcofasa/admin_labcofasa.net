<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetJsonAcceptHeader
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            $request->headers->set('Accept', 'application/json');
        }
        
        return $next($request);
    }
}
