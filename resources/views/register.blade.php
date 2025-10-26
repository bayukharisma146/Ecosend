<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar | Ecosend</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-[Poppins] bg-gradient-to-r from-green-50 via-white to-green-50">

  @include('components.navbar')

  <main class="flex items-center justify-center min-h-screen px-4">
    <div class="flex flex-col md:flex-row bg-white rounded-2xl shadow-lg overflow-hidden max-w-5xl w-full">

      <!-- Kiri -->
      <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">
          Buat Akun <span class="text-green-600">ECOSEND</span>
        </h1>

        {{-- LERT NOTIFIKASI --}}
        @if (session('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
          </div>
        @endif

        @if ($errors->any())
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Oops!</strong> Lengkapi data dengan benar:
            <ul class="mt-2 list-disc list-inside text-sm">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- FORM REGISTER --}}
        <form action="{{ route('register.process') }}" method="POST" class="space-y-4">
          @csrf

          <div>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
          </div>

          <div>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
          </div>

          <div>
            <input type="password" name="password" placeholder="Password" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
          </div>

          <div>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
          </div>

          <button type="submit"
            class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 transition duration-300">
            DAFTAR
          </button>

          <p class="text-center text-gray-600 mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">MASUK SEKARANG</a>
          </p>
        </form>
      </div>

      <!-- Kanan -->
      <div class="hidden md:flex w-1/2 items-center justify-center bg-green-50 p-6">
        <img src="{{ asset('images/mobil-listrik.png') }}" alt="Mobil Listrik Ecosend" class="max-w-xs md:max-w-sm">
      </div>
    </div>
  </main>
  
  <script>
    setTimeout(() => {
      document.querySelectorAll('[role="alert"]').forEach(el => el.remove());
    }, 4000);
  </script>


  @include('components.footer')

</body>

</html>