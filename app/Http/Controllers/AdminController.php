<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // nanti bisa diarahkan ke view dashboard admin
        return view('admin.dashboard');
    }
}
