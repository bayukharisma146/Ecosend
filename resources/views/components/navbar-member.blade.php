<nav class="navbar-member">
  <div class="container">
    {{-- Logo --}}
    <div class="logo">
      <a href="{{ url('/') }}">
        <img src="{{ asset('images/logo-ecosend.png') }}" alt="Ecosend Logo" />
        <span>ECOSEND</span>
      </a>
    </div>

    {{-- Navigasi Member --}}
    <ul class="nav-links">
      <li><a href="{{ url('/pesan') }}" class="{{ request()->is('pesan') ? 'active' : '' }}">Pesan</a></li>
      <li><a href="{{ url('/history') }}" class="{{ request()->is('history') ? 'active' : '' }}">History</a></li>
    </ul>

    {{-- Dropdown Profil --}}
    <div class="user-dropdown">
      <button class="user-btn">
        <i class="fa-solid fa-user-circle"></i>
        <span>Halo, {{ Auth::user()->name ?? 'Member' }}</span>
        <i class="fa-solid fa-chevron-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="{{ route('profile') }}"><i class="fa-solid fa-user"></i> Profil Saya</a>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
        </form>
      </div>
    </div>

    {{-- Toggle Menu (Mobile) --}}
    <div class="menu-toggle">
      <i class="fa fa-bars"></i>
    </div>
  </div>
</nav>
