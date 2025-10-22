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
