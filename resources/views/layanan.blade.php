<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecosend | Layanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-r from-green-50 via-white to-green-50 min-h-screen">
  @include('components.navbar')

  {{-- Konten Utama --}}
  <main class="content py-16">
    <section class="intro">
      <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-10 mt-20">
          Layanan <span class="text-green-600">Ecosend</span>
        </h1>

        <div class="features grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Card 1 -->
          <div
            class="card bg-white shadow-lg rounded-2xl p-8 hover:shadow-2xl transition-transform transform hover:-translate-y-2">
            <div class="text-green-500 text-5xl mb-4">
              <i class="fa-solid fa-motorcycle"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">ECOSEND Lite</h3>
            <p class="text-gray-600">Pengiriman barang kecil via motor listrik</p>
          </div>

          <!-- Card 2 -->
          <div
            class="card bg-white shadow-lg rounded-2xl p-8 hover:shadow-2xl transition-transform transform hover:-translate-y-2">
            <div class="text-green-500 text-5xl mb-4">
              <i class="fa-solid fa-car-side"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">ECOSEND Move</h3>
            <p class="text-gray-600">Pengiriman barang besar via mobil listrik</p>
          </div>

          <!-- Card 3 -->
          <div
            class="card bg-white shadow-lg rounded-2xl p-8 hover:shadow-2xl transition-transform transform hover:-translate-y-2">
            <div class="text-green-500 text-5xl mb-4">
              <i class="fa-solid fa-briefcase"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">ECOSEND Corporate</h3>
            <p class="text-gray-600">Layanan kontrak untuk perusahaan / toko online</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  @include('components.footer')

</body>

</html>