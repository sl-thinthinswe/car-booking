@extends('layouts.customer.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
  <div class="flex flex-col lg:flex-row lg:space-x-16 space-y-10 lg:space-y-0">
    <!-- Left Content -->
    <div class="flex-1 max-w-lg mx-auto lg:mx-0">
      <h1 class="text-3xl sm:text-4xl font-bold mb-6">Book Car Tickets Across Myanmar</h1>
      <p class="text-lg mb-8">Quick & Easy — Secure Your Seat in Just 3 Minutes!</p>

      <div class="grid grid-cols-2 gap-4">
        <div class="bg-cyan-800 text-white rounded-lg p-4 flex items-center justify-center font-semibold text-sm sm:text-base">
          ✅ Get Your Preferred Seat
        </div>
        <div class="bg-cyan-800 text-white rounded-lg p-4 flex items-center justify-center font-semibold text-sm sm:text-base">
          ✅ Instant Confirmation
        </div>
        <div class="bg-cyan-800 text-white rounded-lg p-4 flex items-center justify-center font-semibold text-sm sm:text-base">
          ✅ Over 100 Operators
        </div>
        <div class="bg-cyan-800 text-white rounded-lg p-4 flex items-center justify-center font-semibold text-sm sm:text-base">
          ✅ 24/7 Support
        </div>
      </div>
    </div>

    <!-- Right Content (Booking Form) -->
    <div class="flex-1 max-w-md mx-auto w-full bg-white rounded-lg p-6 shadow-lg">
      <form action="#" method="GET" class="space-y-6">
        @csrf
        <div class="flex border-b border-gray-300">
          <button type="button" class="flex-1 text-cyan-600 font-bold border-b-2 border-cyan-600 px-4 py-2">Express Car</button>
          <button type="button" class="relative flex-1 text-gray-600 px-4 py-2">
            Small Car
            <span class="text-xs bg-red-500 text-white px-1 rounded ml-2">new</span>
          </button>
        </div>

        <select name="from" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-600" required>
          <option value="" disabled selected>From</option>
        </select>

        <select name="to" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-600" required>
        <option value="" disabled selected>To</option>

        </select>

        <input type="date" name="travel_date" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-600" required />

        <div>
          <label for="seatCount" class="block mb-2 font-semibold text-gray-700">Seat</label>
          <div class="flex items-center border border-gray-300 rounded overflow-hidden w-max">
            <button type="button" id="decrement" class="px-4 py-2 text-xl hover:bg-gray-100 transition select-none">−</button>
            <input type="text" id="seatCount" name="numberOfSeats" value="1" readonly class="w-14 text-center py-2 border-l border-r border-gray-300 focus:outline-none" />
            <button type="button" id="increment" class="px-4 py-2 text-xl hover:bg-gray-100 transition select-none">+</button>
          </div>
        </div>

        <button type="submit" class="w-full bg-cyan-700 hover:bg-cyan-800 transition text-white font-semibold rounded py-3 mt-4">
          Search
        </button>
      </form>
    </div>
  </div>

  <!-- Feature Cards -->
  <div class="mt-16 py-12 px-4 rounded-lg">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 text-center">
        @php
          $features = [
            ['icon' => 'bus-alt', 'title' => '100+ Car Operators', 'desc' => 'Choose from 100+ major Car operators covering 200 destinations.'],
            ['icon' => 'clock', 'title' => 'Instant Booking', 'desc' => 'Book your trip in less than 3 minutes. Instant confirmation after payment.'],
            ['icon' => 'shield-alt', 'title' => 'Secure Payment', 'desc' => 'Pay with WaveMoney, CBPay, KBZPay and AYAPay.'],
            ['icon' => 'headset', 'title' => 'Help 24/7', 'desc' => 'Our support center is available 24/7 for your questions and concerns.']
          ];
        @endphp

        @foreach($features as $feature)
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <div class="text-blue-500 text-4xl mb-4">
            <i class="fas fa-{{ $feature['icon'] }}"></i>
          </div>
          <h3 class="text-lg font-semibold mb-2">{{ $feature['title'] }}</h3>
          <p class="text-gray-600 mb-4">{{ $feature['desc'] }}</p>
          <a href="#" class="text-blue-500 font-medium hover:underline">Learn More →</a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('increment').addEventListener('click', () => {
    const seatInput = document.getElementById('seatCount');
    seatInput.value = parseInt(seatInput.value) + 1;
  });

  document.getElementById('decrement').addEventListener('click', () => {
    const seatInput = document.getElementById('seatCount');
    if (parseInt(seatInput.value) > 1) {
      seatInput.value = parseInt(seatInput.value) - 1;
    }
  });
</script>

<!-- We Accept Section -->
<section class="bg-white py-8 px-4 sm:px-8 lg:px-16">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">We Accept</h2>
    <div class="flex flex-wrap justify-center items-center gap-16">
      <img src="{{ asset('images/789a89a0da9acdf8b41fad39f69b9531.jpg') }}" alt="WaveMoney" class="w-20 h-20 rounded-xl" />
      <img src="{{ asset('images/11f074fe04271ca1f562331d873344f8 (1).jpg') }}" alt="KBZPay" class="w-20 h-20" />
      <img src="{{ asset('images/cartoon.jpg') }}" alt="CBPay" class="w-20 h-20" />
      <img src="{{ asset('images/photo_2025-07-03_20-33-44.jpg') }}" alt="AYA" class="w-20 h-20" />
    </div>
  </div>
</section>

<!-- Popular Routes -->
<section class="bg-white py-16 px-4 sm:px-8 lg:px-16">
  <div class="max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Popular Routes</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
      @php
        $popularRoutes = [
          ['title' => 'Yangon - Mandalay', 'desc' => '(Tomorrow - 1 seat - Myanmar)', 'image' => 'images/Mandalay.jpg', 'link' => '#'],
          ['title' => 'Yangon - Bagan', 'desc' => '', 'image' => 'images/Bagan.jpg', 'link' => '#'],
          ['title' => 'Yangon - Naypyidaw (Bawga)', 'desc' => '', 'image' => 'images/Nay.jpg', 'link' => '#'],
          ['title' => 'Yangon - Mawlamyine', 'desc' => '', 'image' => 'images/Maw.jpg', 'link' => '#'],
        ];
      @endphp

      @foreach($popularRoutes as $route)
      <div class="group relative rounded-xl overflow-hidden shadow-md h-72">
        <img src="{{ asset($route['image']) }}" alt="{{ $route['title'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
        <div class="absolute bottom-3 left-3 z-10">
          <h3 class="text-white text-sm font-semibold">{{ $route['title'] }}</h3>
        </div>
        <div class="absolute inset-0 bg-black bg-opacity-80 flex flex-col justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center px-4">
          <h3 class="text-white text-lg font-bold mb-2">{{ $route['title'] }}</h3>
          @if($route['desc'])<p class="text-sm text-white mb-4">{{ $route['desc'] }}</p>@endif
          <a href="{{ $route['link'] }}" class="bg-white text-cyan-700 hover:bg-cyan-700 hover:text-white px-4 py-2 rounded-full font-medium transition">Search Trip</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection