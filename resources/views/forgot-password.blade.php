<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password | Ecosend</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

@include('components.navbar')

<main class="login-page">
  <div class="login-container">
    <div class="login-left">
      <h1>Lupa <span>Password</span>?</h1>
      <p class="info-text">Masukkan email dan password baru untuk mengganti password akun kamu.</p>

      <form class="login-form" method="POST" action="{{ route('forgot-password.process') }}">
        @csrf

        <div class="input-group">
          <input type="email" name="email" placeholder="E-Mail" required>
        </div>

        <div class="input-group">
          <input type="password" name="password" placeholder="Password Baru" required>
        </div>

        <div class="input-group">
          <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
        </div>

        <button type="submit" class="btn-login">RESET PASSWORD</button>

        <p class="register-text">
          Sudah ingat password? <a href="/login">MASUK</a>
        </p>

        @if(session('success'))
          <p style="color: green; margin-top: 10px;">{{ session('success') }}</p>
        @endif

        @if(session('error'))
          <p style="color: red; margin-top: 10px;">{{ session('error') }}</p>
        @endif
      </form>
    </div>

    <div class="login-right">
      <img src="{{ asset('images/mobil-listrik.png') }}" alt="Mobil Listrik Ecosend">
    </div>
  </div>
</main>

@include('components.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '{{ session('success') }}',
      confirmButtonColor: '#2ecc71'
    });
  </script>
@endif

@if(session('error'))
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: '{{ session('error') }}',
      confirmButtonColor: '#e74c3c'
    });
  </script>
@endif

</body>
</html>
