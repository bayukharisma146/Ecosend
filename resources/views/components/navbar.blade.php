<nav class="navbar">
  <div class="container">
    {{-- Logo --}}
    <div class="logo">
      <a href="{{ url('/') }}">
        <img src="{{ asset('images/logo-ecosend.png') }}" alt="Ecosend Logo" />
        <span>ECOSEND</span>
      </a>
    </div>

    {{-- Navigasi --}}
    <ul class="nav-links">
      <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
      <li><a href="{{ url('/layanan') }}" class="{{ request()->is('layanan') ? 'active' : '' }}">Layanan</a></li>
      <li><a href="{{ url('/dampak-hijau') }}" class="{{ request()->is('dampak-hijau') ? 'active' : '' }}">Dampak Hijau</a></li>
      <li><a href="{{ url('/login') }}">Masuk / Daftar</a></li>
      <li><a href="{{ url('/lacak') }}">Lacak</a></li>
    </ul>

    {{-- Kotak Pencarian --}}
    <div class="search-box">
      <input type="text" placeholder="Cari..." />
      <button><i class="fa fa-search"></i></button>
    </div>

    {{-- Toggle Menu (mobile) --}}
    <div class="menu-toggle">
      <i class="fa fa-bars"></i>
    </div>
  </div>
</nav>
