@extends('layouts.customer.app') 

@section('content')
<div class="container mt-5">
    
<section class="bg-white py-8 px-4 sm:px-8 lg:px-16">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">How would you like to</h2>
    <div class="flex flex-wrap justify-center items-center gap-16">
      <!-- Clipped images using clip-path -->
      <img src="{{ asset('images/wave.jpg') }}" alt="WaveMoney" class="w-20 h-20 rounded-full border-4 border-blue-500" />
      <img src="{{ asset('images/kbz.jpg') }}" alt="KBZPay" class="w-20 h-20 rounded-full border-4 border-blue-500" />
      <img src="{{ asset('images/cartoon.jpg') }}" alt="CBPay" class="w-20 h-20 rounded-full border-4 border-blue-500" />
      <img src="{{ asset('images/AYA.jpg') }}" alt="AYA" class="w-20 h-20 rounded-full border-4 border-blue-500" />
    </div>
  </div>
</section>
@endsection
