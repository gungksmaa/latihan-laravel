<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DestinasiController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Middleware\ApiAuthenticate;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Support\Facades\Route;

// Versioning: /api/v1/...
Route::prefix('v1')->middleware(ForceJsonResponse::class)->group(function () {

    // ---------- Publik ----------
    // Auth dibatasi 6 permintaan/menit per IP (anti brute force)
    Route::middleware('throttle:6,1')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::get('kategori', [KategoriController::class, 'index']);
    Route::get('destinasi', [DestinasiController::class, 'index']);
    Route::get('destinasi/{destinasi}', [DestinasiController::class, 'show']);

    // ---------- Wajib token (Sanctum) ----------
    Route::middleware(ApiAuthenticate::class.':sanctum')->group(function () {
        Route::get('profile', [AuthController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);

        // Mutasi data: hanya admin
        Route::middleware(EnsureUserIsAdmin::class)->group(function () {
            Route::post('destinasi', [DestinasiController::class, 'store']);
            Route::match(['put', 'patch'], 'destinasi/{destinasi}', [DestinasiController::class, 'update']);
            Route::delete('destinasi/{destinasi}', [DestinasiController::class, 'destroy']);
        });
    });
});
