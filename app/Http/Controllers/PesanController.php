<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PesanController extends Controller
{
    public function create()
    {
        return view('user.pesan');
    }

    // API untuk estimasi harga via AJAX
    public function estimatePrice(Request $request)
    {
        $pickup = $request->pickup;
        $destination = $request->destination;

        if(!$pickup || !$destination){
            return response()->json(['success' => false]);
        }

        $pickupCoord = $this->geocodeAddress($pickup);
        $destinationCoord = $this->geocodeAddress($destination);

        if (!$pickupCoord || !$destinationCoord) {
            return response()->json(['success' => false]);
        }

        $distanceKm = $this->calculateDistance($pickupCoord, $destinationCoord);
        $price = 25000 + ($distanceKm * 10000);

        return response()->json([
            'success' => true,
            'price' => number_format($price, 0, ',', '.'),
            'distance_km' => round($distanceKm, 2),
        ]);
    }

    // Simpan pesanan ke database
    public function store(Request $request)
{
    $request->validate([
        'pickup_address' => 'required|string',
        'destination_address' => 'required|string',
        'vehicle' => 'required|string',
        'time' => 'required|string',
    ]);

    $pickupCoord = $this->geocodeAddress($request->pickup_address);
    $destinationCoord = $this->geocodeAddress($request->destination_address);

    if (!$pickupCoord || !$destinationCoord) {
        return back()->withErrors('Alamat tidak ditemukan.');
    }

    $distanceKm = $this->calculateDistance($pickupCoord, $destinationCoord);
    $price = 25000 + ($distanceKm * 10000);

    // === Generate Kode Resi Unik ===
    $latestOrder = \App\Models\Order::latest()->first();
    $nextId = $latestOrder ? $latestOrder->id + 1 : 1;
    $resi = 'ECO-' . date('Ymd') . str_pad($nextId, 3, '0', STR_PAD_LEFT);

    // === Simpan Pesanan ===
    $order = \App\Models\Order::create([
        'user_id' => \Auth::id(),
        'resi' => $resi,
        'pickup_address' => $request->pickup_address,
        'destination_address' => $request->destination_address,
        'vehicle' => $request->vehicle,
        'time' => $request->time,
        'distance_Km' => $distanceKm,
        'price' => $price,
        'status' => 'proses',
    ]);

    return redirect()->route('user.history')->with('success', 'Pesanan berhasil dibuat! Resi Anda: ' . $resi);
}

    // Halaman history
    public function history()
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('user.history', compact('orders'));
    }

    private function geocodeAddress($address)
    {
        $apiKey = env('LOCATIONIQ_KEY');

        $response = Http::get('https://us1.locationiq.com/v1/search.php', [
            'key' => $apiKey,
            'q' => $address,
            'format' => 'json',
            'limit' => 1,
        ]);

        if ($response->failed()) return null;

        $data = $response->json();

        if (!empty($data) && isset($data[0]['lat'], $data[0]['lon'])) {
            return [
                'lat' => $data[0]['lat'],
                'lon' => $data[0]['lon'],
            ];
        }

        return null;
    }

    private function calculateDistance($pickup, $destination)
    {
        $lat1 = deg2rad($pickup['lat']);
        $lon1 = deg2rad($pickup['lon']);
        $lat2 = deg2rad($destination['lat']);
        $lon2 = deg2rad($destination['lon']);

        $earthRadius = 6371; // km
        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        $a = sin($dLat/2) * sin($dLat/2) +
             cos($lat1) * cos($lat2) *
             sin($dLon/2) * sin($dLon/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        return $earthRadius * $c;
    }
}
