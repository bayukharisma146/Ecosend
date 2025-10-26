<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Route untuk Halaman Umum (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('beranda'))->name('beranda');
Route::get('/layanan', fn() => view('layanan'))->name('layanan');
Route::get('/dampak-hijau', fn() => view('dampak-hijau'))->name('dampak-hijau');

// === Autentikasi ===
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === Lupa Password ===
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'processForgotPassword'])->name('forgot-password.process');

/*
|--------------------------------------------------------------------------
| Route untuk USER (harus login & role = user)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/pesan', [UserController::class, 'pesan'])->name('pesan');
    Route::get('/history', [UserController::class, 'history'])->name('history');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
});


/*
|--------------------------------------------------------------------------
| Route untuk ADMIN (harus login & role = admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
