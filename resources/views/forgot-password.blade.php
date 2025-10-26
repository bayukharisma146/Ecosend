<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password | Ecosend</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-r from-green-50 via-white to-green-50">

  @include('components.navbar')

  <main class="login-page min-h-screen flex items-center justify-center py-12 px-4">
    <div
      class="login-container max-w-5xl w-full flex flex-col md:flex-row items-center bg-white rounded-2xl shadow-lg overflow-hidden">

      <!-- Kiri: Form Lupa Password -->
      <div class="login-left w-full md:w-1/2 p-8 md:p-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
          Lupa <span class="text-green-600">Password</span>?
        </h1>
        <p class="text-gray-600 mb-8">
          Masukkan email dan password baru untuk mengganti password akun kamu.
        </p>

        <form class="login-form space-y-5" method="POST" action="{{ route('forgot-password.process') }}">
          @csrf

          <!-- Input Email -->
          <div class="flex items-center border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 shadow-sm">
            <i class="fa-solid fa-envelope text-green-600 mr-3"></i>
            <input type="email" name="email" placeholder="E-Mail" required
              class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
          </div>

          <!-- Input Password Baru -->
          <div class="flex items-center border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 shadow-sm">
            <i class="fa-solid fa-lock text-green-600 mr-3"></i>
            <input type="password" name="password" placeholder="Password Baru" required
              class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
          </div>

          <!-- Konfirmasi Password -->
          <div class="flex items-center border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 shadow-sm">
            <i class="fa-solid fa-lock text-green-600 mr-3"></i>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
              class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
          </div>

          <!-- Tombol Reset Password -->
          <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md">
            RESET PASSWORD
          </button>

          <!-- Link Masuk -->
          <p class="text-center text-gray-700 text-sm mt-4">
            Sudah ingat password?
            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-semibold">
              MASUK
            </a>
          </p>

          <!-- Pesan Sukses / Error -->
          @if(session('success'))
            <p class="text-green-600 mt-2">{{ session('success') }}</p>
          @endif

          @if(session('error'))
            <p class="text-red-600 mt-2">{{ session('error') }}</p>
          @endif
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