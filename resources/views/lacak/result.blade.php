<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Pelacakan | Ecosend</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Inter', sans-serif;
    }

    .result-section {
      padding: 4rem 1rem;
      min-height: 80vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .result-container {
      background: white;
      border-radius: 1rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      width: 100%;
      max-width: 700px;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .track-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1.5rem;
    }

    .track-table th {
      text-align: left;
      padding: 0.75rem;
      background-color: #f1f5f9;
      font-weight: 600;
      color: #1e293b;
      border-bottom: 1px solid #e2e8f0;
      width: 40%;
    }

    .track-table td {
      padding: 0.75rem;
      color: #334155;
      border-bottom: 1px solid #e2e8f0;
    }

    .btn-back {
      display: inline-block;
      margin-top: 1.5rem;
      padding: 0.75rem 1.5rem;
      background-color: #22c55e;
      color: white;
      font-weight: 600;
      border-radius: 0.5rem;
      transition: background 0.3s ease;
    }

    .btn-back:hover {
      background-color: #16a34a;
    }

    h2 {
      font-size: 1.75rem;
      font-weight: 700;
      color: #16a34a;
      text-align: center;
    }
  </style>
</head>

<body>
  @include('components.navbar')

  <section class="result-section">
    <div class="result-container">
      <h2><i class="fa-solid fa-location-dot mr-2 text-green-500 mt-10"></i>Hasil Pelacakan</h2>

      <table class="track-table mt-4">
        <tr>
          <th>Nomor Resi</th>
          <td class="font-semibold text-slate-700">{{ $order->resi }}</td>
        </tr>
        <tr>
          <th>Alamat Jemput</th>
          <td>{{ $order->pickup_address }}</td>
        </tr>
        <tr>
          <th>Alamat Tujuan</th>
          <td>{{ $order->destination_address }}</td>
        </tr>
        <tr>
          <th>Jenis Kendaraan</th>
          <td>{{ ucfirst($order->vehicle) }}</td>
        </tr>
        <tr>
          <th>Jarak</th>
          <td>{{ number_format($order->distance_Km, 2) }} Km</td>
        </tr>
        <tr>
          <th>Harga</th>
          <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <th>Status</th>
          <td>
            <span
              class="px-3 py-1 rounded-full text-white text-sm font-semibold 
              {{ $order->status == 'selesai' ? 'bg-green-600' : ($order->status == 'dalam perjalanan' ? 'bg-yellow-500' : 'bg-gray-400') }}">
              {{ ucfirst($order->status) }}
            </span>
          </td>
        </tr>
        <tr>
          <th>Tanggal Pesan</th>
          <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
        </tr>
      </table>

      <div class="text-center mt-6">
        <a href="{{ route('lacak.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left mr-2"></i>Lacak Lagi</a>
      </div>
    </div>
  </section>

  @include('components.footer')
</body>

</html>