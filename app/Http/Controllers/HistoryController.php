<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class HistoryController extends Controller
{
    // Hanya user yang login yang bisa mengakses history
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan semua riwayat pemesanan user yang sedang login
     */
    public function index()
    {
        // Ambil semua order user saat ini, terbaru di atas
        $orders = auth()->user()->orders()->latest()->get();

        // Kirim data ke view history
        return view('user.history', compact('orders'));
    }
}
