<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecosend | Layanan</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  @include('components.navbar')

  {{-- Konten Utama --}}
  <main class="content">
    <section class="intro">
      <div class="container">
        <h1 class="title">Layanan <span class="highlight">Ecosend</span></h1>

        <div class="features">
        <div class="card">
          <i class="fa-solid fa-motorcycle"></i>
          <h3>ECOSEND Lite</h3>
          <p>Pengiriman barang kecil Via motor listrik</p>
        </div>

        <div class="card">
          <i class="fa-solid fa-car-side"></i>
          <h3>ECOSEND Move</h3>
          <p>Pengiriman barang besar Via mobil listrik</p>
        </div>

        <div class="card">
          <i class="fa-solid fa-briefcase"></i>
          <h3>ECOSEND Corporate</h3>
          <p>Layanan kontrak untuk perusahaan / toko online</p>
        </div>
      </div>

        </div>
      </div>
    </section>
  </main>
  @include('components.footer')

</body>
</html>
