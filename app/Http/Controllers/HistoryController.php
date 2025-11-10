<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class HistoryController extends Controller
{
    /**
     * Hanya user yang login yang bisa mengakses history
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan semua riwayat pemesanan user yang sedang login
     */
    public function index()
    {
        // Ambil semua order user saat ini, urutkan dari yang terbaru
        $orders = auth()->user()->orders()->latest()->get();

        // Kirim data ke view history
        return view('user.history', compact('orders'));
    }

    /**
     * Hapus pesanan tertentu
     */
    public function destroy(Order $order)
    {
        // Pastikan hanya pemilik order yang boleh hapus
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan menghapus pesanan ini.');
        }

        $order->delete();

        return back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
