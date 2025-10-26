<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class LacakController extends Controller
{
    public function index()
    {
        return view('lacak.lacak');
    }

    public function search(Request $request)
    {
        $request->validate([
            'resi' => 'required',
            'vehicle' => 'required'
        ]);

        // Cari pesanan berdasarkan ID (resi)
        $order = Order::where('resi', $request->resi)
            ->where('vehicle', $request->vehicle)
            ->first();


        if (!$order) {
            return back()->with('error', 'Nomor resi tidak ditemukan atau tidak sesuai kendaraan.');
        }

        return view('lacak.result', compact('order'));
    }
}
