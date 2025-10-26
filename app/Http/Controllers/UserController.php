<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function pesan()
    {
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

    public function submitOrder(Request $request) {
    $data = $request->validate([
        'alamat_penjemputan' => 'required|string',
        'alamat_tujuan' => 'required|string',
        'kendaraan' => 'required|string',
        'waktu' => 'required|string'
    ]);

    $data['jarak'] = $request->jarak ?? null;
    $data['biaya'] = $request->biaya ?? null;

    // Simpan ke database atau lakukan proses order
    // Order::create($data);

    return redirect()->back()->with('success', 'Order berhasil dibuat!');
}
}

