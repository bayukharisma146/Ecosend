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
        'phone' => ['required', 'regex:/^(08|62)[0-9]{8,13}$/'],
    ], [
        'phone.regex' => 'Nomor telepon harus diawali dengan 08 atau 62 dan hanya berisi angka.',
    ]);

    // Normalisasi nomor telepon
    $phone = $request->phone;

    // Jika dimulai dengan 0, ubah ke format 62
    if (preg_match('/^0/', $phone)) {
        $phone = '62' . substr($phone, 1);
    }

    $pickupCoord = $this->geocodeAddress($request->pickup_address);
    $destinationCoord = $this->geocodeAddress($request->destination_address);

    if (!$pickupCoord || !$destinationCoord) {
        return back()->withErrors('Alamat tidak ditemukan.');
    }

    $distanceKm = $this->calculateDistance($pickupCoord, $destinationCoord);
    $price = 25000 + ($distanceKm * 10000);

    // Generate kode resi unik
    $latestOrder = Order::latest()->first();
    $nextId = $latestOrder ? $latestOrder->id + 1 : 1;
    $resi = 'ECO-' . date('Ymd') . str_pad($nextId, 3, '0', STR_PAD_LEFT);

    // Simpan pesanan
    Order::create([
        'user_id' => Auth::id(),
        'resi' => $resi,
        'pickup_address' => $request->pickup_address,
        'destination_address' => $request->destination_address,
        'vehicle' => $request->vehicle,
        'time' => $request->time,
        'phone' => $phone, // simpan nomor telepon yang sudah diformat
        'distance_km' => $distanceKm,
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

    // --- 1️⃣ Coba pakai LocationIQ lebih dulu ---
    try {
        $response = Http::timeout(8)->get('https://us1.locationiq.com/v1/search.php', [
            'key' => $apiKey,
            'q' => $address,
            'format' => 'json',
            'limit' => 1,
        ]);

        if ($response->ok()) {
            $data = $response->json();

            if (!empty($data) && isset($data[0]['lat'], $data[0]['lon'])) {
                return [
                    'lat' => $data[0]['lat'],
                    'lon' => $data[0]['lon'],
                    'source' => 'locationiq'
                ];
            }
        }
    } catch (\Exception $e) {
        \Log::warning('LocationIQ gagal: ' . $e->getMessage());
    }

    // --- 2️⃣ Jika LocationIQ gagal, coba pakai Nominatim (backup) ---
    try {
        $response = Http::timeout(8)->get('https://nominatim.openstreetmap.org/search', [
            'q' => $address,
            'format' => 'json',
            'limit' => 1,
        ]);

        if ($response->ok()) {
            $data = $response->json();

            if (!empty($data) && isset($data[0]['lat'], $data[0]['lon'])) {
                return [
                    'lat' => $data[0]['lat'],
                    'lon' => $data[0]['lon'],
                    'source' => 'nominatim'
                ];
            }
        }
    } catch (\Exception $e) {
        \Log::error('Nominatim juga gagal: ' . $e->getMessage());
    }

    // --- 3️⃣ Jika semua gagal ---
    \Log::error('Gagal geocode alamat: ' . $address);
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
