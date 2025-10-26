<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lacak Pengiriman | Ecosend</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-r from-green-50 via-white to-green-50 min-h-screen">
  @include('components.navbar')

  <section class="track-section py-16">
    <div class="track-container max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-12">

      <!-- Kiri: Form Lacak -->
      <div class="track-left w-full md:w-1/2 text-center md:text-left">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-6">
          Lacak <span class="text-green-600">Pengiriman</span>
        </h2>

        @if(session('error'))
          <p class="text-red-600 text-sm font-medium mb-4">
            {{ session('error') }}
          </p>
        @endif

        <form action="{{ route('lacak.search') }}" method="POST" class="space-y-4">
          @csrf

          <!-- Input Resi -->
          <div class="flex items-center bg-white border border-gray-300 rounded-lg shadow-sm px-4 py-2">
            <i class="fa-solid fa-barcode text-green-600 mr-3"></i>
            <input type="text" name="resi" placeholder="Nomor Resi" required
              class="w-full outline-none text-gray-700 placeholder-gray-400">
          </div>

          <!-- Pilih Kendaraan -->
          <div class="flex items-center bg-white border border-gray-300 rounded-lg shadow-sm px-4 py-2">
            <i class="fa-solid fa-truck text-green-600 mr-3"></i>
            <select name="vehicle" required class="w-full bg-transparent outline-none text-gray-700">
              <option value="motor">Motor Listrik</option>
              <option value="mobil">Mobil Listrik</option>
            </select>
          </div>

          <!-- Tombol -->
          <button type="submit"
            class="w-full md:w-auto bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200 shadow-md">
            PESAN LACAK
          </button>
        </form>
      </div>

      <!-- Kanan: Gambar -->
      <div class="track-right w-full md:w-1/2 flex justify-center">
        <img src="{{ asset('images/mobil-listrik.png') }}" alt="Lacak Pengiriman"
          class="w-80 md:w-[420px] drop-shadow-lg">
      </div>

    </div>
  </section>


  @include('components.footer')
</body>

</html>