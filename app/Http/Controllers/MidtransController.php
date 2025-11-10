<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function __construct()
    {
        $midtrans = config('services.midtrans');
        Config::$serverKey = $midtrans['serverKey'];
        Config::$isProduction = $midtrans['isProduction'];
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getToken(Order $order)
    {
        if ($order->status != 'pending') {
            return response()->json(['error' => 'Order sudah dibayar'], 400);
        }

        try {
            $params = [
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => $order->price,
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->phone,
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            \Log::error('Midtrans Token Error: ' . $e->getMessage());
            return response()->json(['error' => 'Token pembayaran tidak tersedia'], 500);
        }
    }

    public function callback(Request $request)
    {
        Log::info('📩 Raw Callback Received', ['body' => $request->all()]);

        try {
            // Pastikan ada payload sebelum membuat Notification
            if (empty($request->all())) {
                Log::warning('⚠️ Empty callback payload, mungkin bukan dari Midtrans.');
                return response()->json(['message' => 'Empty payload'], 400);
            }

            $notification = new Notification();

            $transaction = $notification->transaction_status ?? null;
            $orderId     = $notification->order_id ?? null;
            $fraud       = $notification->fraud_status ?? null;

            Log::info('✅ Callback parsed', [
                'order_id' => $orderId,
                'status' => $transaction,
                'fraud' => $fraud
            ]);

            if (!$orderId) {
                return response()->json(['message' => 'Invalid callback'], 400);
            }

            // Lanjut: update status transaksi kamu di database
            return response()->json(['message' => 'Callback processed']);
        } catch (\Exception $e) {
            Log::error('🔥 Midtrans Callback Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Midtrans webhook untuk update status otomatis
    public function notification(Request $request)
    {
        $notif = new Notification();
        Log::info('🔔 Midtrans Webhook diterima', $request->all());
        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status;

        $order = Order::find($orderId);
        if (!$order) {
            Log::warning('Order not found: ' . $orderId);
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

        // Update status sesuai Midtrans
        if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
            $order->status = 'proses';
        } elseif ($transactionStatus === 'pending') {
            $order->status = 'pending';
        } elseif ($transactionStatus === 'deny' || $transactionStatus === 'cancel' || $transactionStatus === 'expire') {
            $order->status = 'gagal';
        }

        $order->save(); // <- INI BARU MERUBAH DATABASE

        Log::info('Midtrans Webhook updated order ' . $orderId . ' status: ' . $order->status);

        return response()->json(['ok']);
    }
}
