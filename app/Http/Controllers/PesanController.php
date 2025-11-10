<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PesanController extends Controller
{
    /**
     * Tampilkan form pemesanan
     */
    public function create()
    {
        return view('user.pesan'); // Pastikan nama file Blade sesuai
    }

    /**
     * Simpan data ke tabel orders
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'pickup_address' => 'required|string',
            'destination_address' => 'required|string',
            'vehicle' => 'required|string',
            'price' => 'nullable|numeric',
            'distance_Km' => 'nullable|numeric',
        ]);

        // Simpan ke database
        $order = Order::create([
            'user_id' => Auth::id(),
            'phone' => $request->phone,
            'pickup_address' => $request->pickup_address,
            'destination_address' => $request->destination_address,
            'vehicle' => $request->vehicle,
            'distance_Km' => $request->distance_Km ?? 0, 
            'price' => $request->price ?? 0,
            'status' => 'pending', 
            'resi' => 'ECO-' . strtoupper(uniqid()),
        ]);

        return redirect()->route('user.history')
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Estimasi harga (AJAX)
     */
    public function estimatePrice(Request $request)
    {
        $pickup = $request->pickup;
        $destination = $request->destination;

        if (!$pickup || !$destination) {
            return response()->json(['success' => false]);
        }

        // Ambil koordinat lokasi (pakai geocoding ORS)
        $apiKey = env('ORS_API_KEY');
        $geoUrl = "https://api.openrouteservice.org/geocode/search";

        $pickupResponse = Http::get($geoUrl, [
            'api_key' => $apiKey,
            'text' => $pickup,
        ]);

        $destinationResponse = Http::get($geoUrl, [
            'api_key' => $apiKey,
            'text' => $destination,
        ]);

        // Ambil koordinat pertama dari hasil geocoding
        $pickupCoords = $pickupResponse['features'][0]['geometry']['coordinates'] ?? null;
        $destinationCoords = $destinationResponse['features'][0]['geometry']['coordinates'] ?? null;

        if (!$pickupCoords || !$destinationCoords) {
            return response()->json(['success' => false, 'message' => 'Alamat tidak ditemukan']);
        }

        // Hitung jarak dengan ORS Directions API
        $directionsUrl = "https://api.openrouteservice.org/v2/directions/driving-car";
        $directionResponse = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->post($directionsUrl, [
            'coordinates' => [
                $pickupCoords,
                $destinationCoords,
            ],
        ]);

        if (!$directionResponse->ok()) {
            return response()->json(['success' => false]);
        }

        $data = $directionResponse->json();
        $distanceMeters = $data['routes'][0]['summary']['distance'] ?? 0;
        $distanceKm = round($distanceMeters / 1000, 2);
        $price = $distanceKm * 3000; // contoh Rp 3.000/km

        return response()->json([
            'success' => true,
            'distance_Km' => $distanceKm,
            'price' => number_format($price, 0, ',', '.'),
            'price_raw' => $price,
        ]);
    }

    /**
     * Tampilkan riwayat pemesanan user
     */
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.history', compact('orders'));
    }
}
