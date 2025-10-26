<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lacak Pengiriman | Ecosend</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/lacak.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
@include('components.navbar')

<section class="track-section">
  <div class="track-container">
    <div class="track-left">
      <h2>Lacak <span>Pengiriman</span></h2>

      @if(session('error'))
          <p class="error-msg">{{ session('error') }}</p>
      @endif

      <form action="{{ route('lacak.search') }}" method="POST">
        @csrf
        <div class="input-group">
          <i class="fa-solid fa-barcode"></i>
          <input type="text" name="resi" placeholder="Nomor Resi" required>
        </div>

        <div class="input-group select-group">
          <i class="fa-solid fa-truck"></i>
          <select name="vehicle" required>
            <option value="motor">Motor Listrik</option>
            <option value="mobil">Mobil Listrik</option>
          </select>
        </div>

        <button type="submit" class="btn-track">PESAN LACAK</button>
      </form>
    </div>

    <div class="track-right">
      <img src="{{ asset('images/mobil-listrik.png') }}" alt="Lacak Pengiriman">
    </div>
  </div>
</section>

@include('components.footer')
</body>
</html>
