<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // halaman utama user (misalnya pemesanan)
        return view('user.pesan');
    }

    public function history()
    {
        return view('user.history');
    }

    public function profile()
    {
        return view('user.profile');
    }
}
