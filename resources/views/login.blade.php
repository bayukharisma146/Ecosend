<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk | Ecosend</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

  @include('components.navbar')

  <main
    class="login-page min-h-screen bg-gradient-to-r from-green-50 via-white to-green-50 flex items-center justify-center py-12 px-4">
    <div
      class="login-container max-w-5xl w-full flex flex-col md:flex-row items-center bg-white rounded-2xl shadow-lg overflow-hidden">

      <!-- Kiri: Form Login -->
      <div class="login-left w-full md:w-1/2 p-8 md:p-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
          Masuk ke Akun <span class="text-green-600">ECOSEND</span>
        </h1>

        <form class="login-form space-y-5" method="POST" action="{{ route('login.process') }}">
          @csrf

          <!-- Input Email -->
          <div class="flex items-center border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 shadow-sm">
            <i class="fa-solid fa-envelope text-green-600 mr-3"></i>
            <input type="email" name="email" placeholder="E-Mail" required
              class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
          </div>

          <!-- Input Password -->
          <div class="flex items-center border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 shadow-sm">
            <i class="fa-solid fa-lock text-green-600 mr-3"></i>
            <input type="password" name="password" placeholder="Password" required
              class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
          </div>

          <!-- Lupa Password -->
          <p class="text-sm text-gray-600 text-right">
            <a href="{{ route('forgot-password') }}" class="text-green-600 hover:text-green-700 font-medium">
              Lupa Password?
            </a>
          </p>

          <!-- Tombol Login -->
          <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md">
            MASUK
          </button>

          <!-- Link Daftar -->
          <p class="register-text text-center text-gray-700 text-sm mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold">
              DAFTAR SEKARANG
            </a>
          </p>
        </form>
      </div>

      <!-- Kanan: Gambar -->
      <div class="login-right hidden md:flex w-full md:w-1/2 bg-green-100 items-center justify-center p-6">
        <img src="{{ asset('images/mobil-listrik.png') }}" alt="Mobil Listrik Ecosend"
          class="w-80 md:w-[400px] drop-shadow-lg">
      </div>
    </div>
  </main>


  @include('components.footer')

</body>

</html>