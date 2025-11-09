<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LacakController;
use App\Http\Controllers\ProfileController;

// =======================
// Route Publik
// =======================
Route::get('/', fn() => view('beranda'))->name('beranda');
Route::get('/layanan', fn() => view('layanan'))->name('layanan');
Route::get('/dampak-hijau', fn() => view('dampak-hijau'))->name('dampak-hijau');

// Login & Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Lacak Pengiriman
Route::get('/lacak', [LacakController::class, 'index'])->name('lacak.index');
Route::post('/lacak', [LacakController::class, 'search'])->name('lacak.search');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Lupa Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'processForgotPassword'])->name('forgot-password.process');

// =======================
// Route User (harus login & role user)
// =======================
Route::middleware([UserMiddleware::class])->group(function () {
    Route::get('/pesan', [PesanController::class, 'create'])->name('user.pesan');
    // Form pesan
    // Route::get('/pesan', [PesanController::class, 'create'])->name('pesan.create');

    // Submit form pesan
    Route::post('/pesan', [PesanController::class, 'store'])->name('user.storePesan');

    Route::get('/pesan/estimate', [PesanController::class, 'estimatePrice'])->name('user.estimatePrice');

    // Riwayat pemesanan
    Route::get('/history', [PesanController::class, 'history'])->name('user.history');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
// =======================
// Route Admin (harus login & role admin)
// =======================
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/update-status/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
});
