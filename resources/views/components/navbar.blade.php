<nav class="fixed w-full z-50 bg-white/70 backdrop-blur-md shadow-sm transition-all duration-300">
  <div class="max-w-7xl mx-auto flex items-center justify-between px-4 md:px-8 py-3">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="flex items-center gap-2 group">
      <img src="{{ asset('images/logo-ecosend.png') }}" alt="Ecosend Logo"
        class="w-9 h-9 transition-transform duration-300 group-hover:rotate-12">
      <span class="text-green-700 font-extrabold text-lg tracking-wide">ECOSEND</span>
    </a>

    <!-- Desktop Menu -->
    <ul class="hidden md:flex items-center gap-6 text-green-700 font-medium">
      <li><a href="{{ url('/') }}" class="hover:text-green-900 transition-colors">Beranda</a></li>
      <li>
        <a href="{{ url('/layanan') }}"
          class="bg-green-600 text-white px-4 py-1.5 rounded-full shadow-sm hover:bg-green-700 transition-all duration-300">
          Layanan
        </a>
      </li>
      <li><a href="{{ url('/dampak-hijau') }}" class="hover:text-green-900 transition-colors">Dampak Hijau</a></li>
      <li>
        <a href="{{ url('/login') }}"
          class="border-2 border-green-600 text-green-700 px-4 py-1.5 rounded-full hover:bg-green-600 hover:text-white transition-all duration-300">
          Masuk / Daftar
        </a>
      </li>
      <li><a href="{{ url('/lacak') }}" class="hover:text-green-900 transition-colors">Lacak</a></li>
    </ul>

    <!-- Search Box -->
    <div
      class="hidden md:flex items-center border border-green-600 rounded-full overflow-hidden focus-within:ring-2 focus-within:ring-green-400 transition-all duration-300">
      <input type="text" placeholder="Search..." class="px-3 py-1 outline-none text-sm text-gray-700 w-32 lg:w-44">
      <button class="bg-green-600 px-3 text-white hover:bg-green-700 transition-colors">
        <i class="fa fa-search"></i>
      </button>
    </div>

    <!-- Mobile Menu Toggle -->
    <button id="menu-toggle"
      class="md:hidden text-green-700 text-2xl focus:outline-none transition-transform duration-300">
      <i class="fa fa-bars"></i>
    </button>
  </div>

  <!-- Sidebar Menu (muncul dari kiri) -->
  <div id="mobile-menu"
    class="fixed top-0 left-0 h-screen w-64 bg-white shadow-2xl border-r border-green-100 transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col p-6 space-y-5 z-40">

    <!-- Header -->
    <div class="text-2xl font-bold text-green-700 border-b pb-3">ECOSEND</div>

    <!-- Link Navigasi -->
    <a href="{{ url('/') }}"
      class="block text-green-700 font-medium hover:bg-green-100 px-3 py-2 rounded-md transition">Beranda</a>
    <a href="{{ url('/layanan') }}"
      class="block text-green-700 font-medium hover:bg-green-100 px-3 py-2 rounded-md transition">Layanan</a>
    <a href="{{ url('/dampak-hijau') }}"
      class="block text-green-700 font-medium hover:bg-green-100 px-3 py-2 rounded-md transition">Dampak Hijau</a>
    <a href="{{ url('/login') }}"
      class="block text-green-700 font-medium hover:bg-green-100 px-3 py-2 rounded-md transition">Masuk / Daftar</a>
    <a href="{{ url('/lacak') }}"
      class="block text-green-700 font-medium hover:bg-green-100 px-3 py-2 rounded-md transition">Lacak</a>
  </div>

  <!-- Background Overlay -->
  <div id="menu-overlay" class="fixed inset-0 bg-black/40 hidden z-30"></div>
</nav>

<!-- Script -->
<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const menu = document.getElementById('mobile-menu');
  const overlay = document.getElementById('menu-overlay');
  let open = false;

  toggleBtn.addEventListener('click', () => {
    open = !open;
    if (open) {
      menu.classList.remove('-translate-x-full');
      overlay.classList.remove('hidden');
    } else {
      menu.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
    }
  });

  overlay.addEventListener('click', () => {
    open = false;
    menu.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });
</script>