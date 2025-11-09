<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    // Halaman dashboard / daftar semua pesanan
    public function dashboard()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.dashboard', compact('orders'));
    }

    // // Update status pesanan via AJAX
    // public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|string',
    //     ]);

    //     $order = Order::findOrFail($id);
    //     $order->status = $request->status;
    //     $order->save();

    //     return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui!']);
    // }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        $request->validate([
        'status' => 'required|in:proses,sedang di antar,selesai',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }
}
