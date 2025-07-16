<div class="bg-cyan-800" style="height: 100px !important;">
  <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 relative z-50">
    <div class="flex justify-between items-center">

      <!-- Logo -->
      <div class="flex items-center gap-2 text-xl font-bold text-white">
        <img src="{{ asset('images/2-removebg-preview.png') }}" alt="Car Icon" class="w-10 h-10" />
        <span>SeatSnap</span>
      </div>

      <!-- Hamburger Button (Only on Mobile) -->
      <button id="menu-btn" class="md:hidden focus:outline-none" aria-label="Open menu">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
             stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Desktop Menu -->
      <div class="hidden md:flex md:items-center md:gap-6 text-sm text-white">
        <a href="{{ route('home')}}" class="hover:underline">Home</a>
        <a href="{{ route('print') }}" class="hover:underline">Print Ticket</a>
        <a href="{{ route('faq') }}" class="hover:underline">FAQs</a>
        <a href="{{ route('about') }}" class="hover:underline">About us</a>
      </div>
    </div>
  </nav>

  <!-- Mobile Slide Menu -->
  <div id="mobile-menu"
       class="fixed top-0 right-0 h-full w-64 bg-cyan-900 text-white transform translate-x-full transition-transform duration-300 ease-in-out z-50 md:hidden shadow-lg">
    <div class="flex justify-end p-4">
      <button id="close-btn" aria-label="Close menu" class="text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
             stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <nav class="flex flex-col space-y-6 px-6 mt-4 text-lg text-white">
      <a href="#" class="hover:underline">Home</a>
      <a href="{{ route('print') }}" class="hover:underline">Print Ticket</a>
      <a href="{{ route('faq') }}" class="hover:underline">FAQs</a>
      <a href="{{ route('about') }}" class="hover:underline">About us</a>
    </nav>
  </div>

  <!-- Overlay -->
  <div id="overlay"
       class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 md:hidden"></div>
</div>

<!-- Script to Toggle Menu -->
<script>
  const menuBtn = document.getElementById('menu-btn');
  const closeBtn = document.getElementById('close-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const overlay = document.getElementById('overlay');

  menuBtn.addEventListener('click', () => {
    mobileMenu.classList.remove('translate-x-full');
    overlay.classList.remove('hidden');
  });

  closeBtn.addEventListener('click', () => {
    mobileMenu.classList.add('translate-x-full');
    overlay.classList.add('hidden');
  });

  overlay.addEventListener('click', () => {
    mobileMenu.classList.add('translate-x-full');
    overlay.classList.add('hidden');
  });
</script>
