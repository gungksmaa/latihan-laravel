<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Memaksa seluruh endpoint API menjawab JSON (validasi gagal => 422, bukan redirect)
class ForceJsonResponse
{
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
