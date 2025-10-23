<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda'); // ini halaman beranda
});
Route::get('/layanan', function () {
    return view('layanan'); // ini halaman layanan
});
Route::get('/dampak-hijau', function () {
    return view('dampak-hijau'); // ini halaman dampak hijau
});
Route::get('/login', function () {
    return view('login'); // ini halaman login
});
Route::get('/register', function () {
    return view('register'); // ini halaman register
});
Route::get('/forgot-password', function () {
    return view('forgot-password'); // ini halaman lupa password
});
Route::get('/pesan', function () {
    return view('pesan');
})->name('pesan');

Route::get('/history', function () {
    return view('history');
})->name('history');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');