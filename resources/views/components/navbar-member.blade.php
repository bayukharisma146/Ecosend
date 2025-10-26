<nav class="bg-white shadow-md fixed w-full top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">

      <!-- === Logo === -->
      <div class="flex items-center space-x-2">
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
          <img src="{{ asset('images/logo-ecosend.png') }}" alt="Ecosend Logo" class="h-8 w-8">
          <span class="text-green-700 font-bold text-lg tracking-wide">ECOSEND</span>
        </a>
      </div>

      <!-- === Menu Utama (Desktop) === -->
      <ul class="hidden md:flex space-x-8 text-green-800 font-medium">
        <li>
          <a href="{{ url('/pesan') }}"
            class="hover:text-green-600 transition-colors {{ request()->is('pesan') ? 'text-green-600 font-semibold' : '' }}">
            Pesan
          </a>
        </li>
        <li>
          <a href="{{ url('/history') }}"
            class="hover:text-green-600 transition-colors {{ request()->is('history') ? 'text-green-600 font-semibold' : '' }}">
            History
          </a>
        </li>
      </ul>

      <!-- === User Dropdown === -->
      <div class="relative hidden md:block">
        <button id="userDropdownButton"
          class="flex items-center space-x-2 text-green-700 hover:text-green-900 font-medium focus:outline-none">
          <i class="fa-solid fa-user-circle text-xl"></i>
          <span>Halo, {{ Auth::user()->name ?? 'Member' }}</span>
          <i class="fa-solid fa-chevron-down text-sm"></i>
        </button>

        <!-- Dropdown -->
        <div id="userDropdownMenu"
          class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100">
          <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700">
            <i class="fa-solid fa-user mr-2"></i> Profil Saya
          </a>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
              class="w-full text-left px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700">
              <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar
            </button>
          </form>
        </div>
      </div>

      <!-- === Mobile Toggle === -->
      <div class="md:hidden flex items-center">
        <button id="menuToggle" class="text-green-700 focus:outline-none">
          <i class="fa fa-bars text-2xl"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- === Menu Mobile === -->
  <div id="mobileMenu" class="hidden bg-white border-t border-gray-100 md:hidden">
    <ul class="flex flex-col space-y-2 px-4 py-4 text-green-800">
      <li>
        <a href="{{ url('/pesan') }}"
          class="block py-2 hover:text-green-600 transition-colors {{ request()->is('pesan') ? 'text-green-600 font-semibold' : '' }}">Pesan</a>
      </li>
      <li>
        <a href="{{ url('/history') }}"
          class="block py-2 hover:text-green-600 transition-colors {{ request()->is('history') ? 'text-green-600 font-semibold' : '' }}">History</a>
      </li>
      <li>
        <a href="{{ route('profile.show') }}" class="block py-2 hover:text-green-600 transition-colors"><i
            class="fa-solid fa-user mr-2"></i> Profil Saya</a>
      </li>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full text-left py-2 hover:text-green-600 transition-colors">
          <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar
        </button>
      </form>
    </ul>
  </div>
</nav>

<!-- === SCRIPT === -->
<script>
  // Dropdown User
  const userBtn = document.getElementById('userDropdownButton');
  const userMenu = document.getElementById('userDropdownMenu');

  userBtn?.addEventListener('click', () => {
    userMenu.classList.toggle('hidden');
  });

  // Tutup dropdown jika klik di luar
  document.addEventListener('click', (e) => {
    if (!userBtn.contains(e.target) && !userMenu.contains(e.target)) {
      userMenu.classList.add('hidden');
    }
  });

  // Mobile Menu Toggle
  const menuToggle = document.getElementById('menuToggle');
  const mobileMenu = document.getElementById('mobileMenu');

  menuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>