<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk | Ecosend</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

@include('components.navbar')

<main class="login-page">
  <div class="login-container">
    <div class="login-left">
      <h1>Masuk ke Akun <span>ECOSEND</span></h1>

      <form class="login-form" method="POST" action="{{ route('login.process') }}">
    @csrf
    <div class="input-group">
        <input type="email" name="email" placeholder="E-Mail" required>
    </div>

    <div class="input-group">
        <input type="password" name="password" placeholder="Password" required>
    </div>

    <p class="forgot-password"><a href="{{ route('forgot-password') }}">Lupa Password?</a></p>

    <button type="submit" class="btn-login">MASUK</button>

    <p class="register-text">
        Belum punya akun? <a href="{{ route('register') }}">DAFTAR SEKARANG</a>
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
