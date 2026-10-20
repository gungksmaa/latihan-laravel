<?php

use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;

// ---------- Front page (publik) ----------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinasi', [HomeController::class, 'destinasi'])->name('destinasi');
Route::get('/destinasi/{slug}', [HomeController::class, 'detail'])->name('detail');
Route::get('/promo', [HomeController::class, 'promo'])->name('promo');
Route::get('/keranjang', [HomeController::class, 'keranjang'])->name('keranjang');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

// ---------- Back page (wajib login) ----------
Route::get('/dashboard', function () {
    return view('dashboard', [
        'title' => 'Dashboard',
        'jumlahDestinasi' => Destinasi::count(),
        'jumlahAktif' => Destinasi::where('status', 'Y')->count(),
        'jumlahKategori' => Kategori::count(),
    ]);
})->middleware(['auth'])->name('dashboard');

// Middleware group auth: berlaku untuk seluruh route di dalamnya
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // daftar destinasi berdasarkan kategori
    Route::get('kategori/{id}', [DestinasiController::class, 'kategori'])->name('destinasi.kategori');
    // route CRUD: index, create, store, edit, update, destroy
    Route::resource('destinasi', DestinasiController::class)->except('show');
});

// Route profil bawaan Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
