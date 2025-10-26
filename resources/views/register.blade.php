<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar | Ecosend</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

@include('components.navbar')

<main class="login-page">
  <div class="login-container">
    <div class="login-left">
      <h1>Buat Akun <span>ECOSEND</span></h1>

      <form class="login-form">
        <div class="input-group">
          <input type="text" placeholder="Nama Lengkap" required>
        </div>

        <div class="input-group">
          <input type="email" placeholder="E-Mail" required>
        </div>

        <div class="input-group">
          <input type="password" placeholder="Password" required>
        </div>

        <div class="input-group">
          <input type="password" placeholder="Konfirmasi Password" required>
        </div>

        <button type="submit" class="btn-login">DAFTAR</button>

        <p class="register-text">
          Sudah punya akun? <a href="/login">MASUK SEKARANG</a>
        </p>
      </form>
    </div>

    <div class="login-right">
      <img src="{{ asset('images/mobil-listrik.png') }}" alt="Mobil Listrik Ecosend">
    </div>
  </div>
</main>

@include('components.footer')

</body>
</html>
