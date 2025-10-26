<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Pelacakan | Ecosend</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/lacak.css') }}">
</head>
<body>
@include('components.navbar')

<section class="result-section">
  <div class="result-container">
    <h2>Hasil Pelacakan</h2>

    <table class="track-table">
      <tr><th>Nomor Resi</th><td>{{ $order->id }}</td></tr>
      <tr><th>Alamat Jemput</th><td>{{ $order->pickup_address }}</td></tr>
      <tr><th>Alamat Tujuan</th><td>{{ $order->destination_address }}</td></tr>
      <tr><th>Jenis Kendaraan</th><td>{{ ucfirst($order->vehicle) }}</td></tr>
      <tr><th>Jarak</th><td>{{ number_format($order->distance_Km, 2) }} Km</td></tr>
      <tr><th>Harga</th><td>Rp {{ number_format($order->price, 0, ',', '.') }}</td></tr>
      <tr><th>Status</th><td>{{ ucfirst($order->status) }}</td></tr>
      <tr><th>Tanggal Pesan</th><td>{{ $order->created_at->format('d M Y, H:i') }}</td></tr>
    </table>

    <a href="{{ route('lacak.index') }}" class="btn-back">Lacak Lagi</a>
  </div>
</section>

@include('components.footer')
</body>
</html>
