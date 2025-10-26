<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan Pengiriman | Ecosend</title>
  <link rel="stylesheet" href="{{ asset('css/style-member.css') }}">
  <link rel="stylesheet" href="{{ asset('css/pesan.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
@include('components.navbar-member')

<section class="order-section">
  <div class="order-container">
    <div class="order-left">
      <h2>Pesan Pengiriman Anda <span>Sekarang</span></h2>

      <form class="order-form">
        <div class="input-group">
          <i class="fa-solid fa-location-dot"></i>
          <input type="text" placeholder="Alamat Penjemputan" required>
        </div>

        <div class="input-group">
          <i class="fa-solid fa-location-arrow"></i>
          <input type="text" placeholder="Alamat Tujuan" required>
        </div>

        <div class="input-group select-group">
          <i class="fa-solid fa-truck"></i>
          <select required>
            <option>Motor Listrik</option>
            <option>Mobil Listrik</option>
          </select>
        </div>

        <div class="input-group select-group">
          <i class="fa-solid fa-clock"></i>
          <select required>
            <option>Sekarang</option>
          </select>
        </div>

        <div class="estimate">
          <p>Estimasi Biaya</p>
          <h3>Rp 25.000 - Rp 100.000</h3>
        </div>

        <button type="submit" class="btn-order">PESAN SEKARANG</button>
      </form>
    </div>

    <div class="order-right">
      <img src="{{ asset('images/mobil-listrik.png') }}" alt="Mobil Listrik Ecosend">
    </div>
  </div>
</section>

@include('components.footer')
</body>
</html>
