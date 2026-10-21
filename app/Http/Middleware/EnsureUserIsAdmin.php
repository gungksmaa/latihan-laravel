<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Pengamanan mutasi data: hanya admin dengan token berkemampuan destinasi:write
class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'admin' || ! $user->tokenCan('destinasi:write')) {
            return response()->json(['message' => 'Anda tidak memiliki izin untuk aksi ini.'], 403);
        }

        return $next($request);
    }
}
