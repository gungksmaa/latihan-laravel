<?php

namespace App\Http\Middleware;

use Closure;

// Sama seperti auth bawaan, tetapi tanpa token selalu menjawab 401 JSON (bukan redirect ke /login)
class ApiAuthenticate extends Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        $request->headers->set('Accept', 'application/json');

        return parent::handle($request, $next, ...$guards);
    }
}
