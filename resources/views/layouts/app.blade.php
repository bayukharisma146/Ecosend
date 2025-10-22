<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecosend - Green Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="#">🌱 ECOSEND</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Dampak Hijau</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-success text-white px-3" href="#">Masuk / Daftar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Lacak</a></li>
                    <li>
                        <form class="d-flex align-items-center">
                            <input class="form-control form-control-sm me-2" type="search" placeholder="Search...">
                            <button class="btn btn-success btn-sm">🔍</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div style="margin-top: 80px;">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
