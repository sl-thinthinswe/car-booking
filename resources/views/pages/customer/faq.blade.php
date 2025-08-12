@extends('layouts.customer.app')

@section('title', 'FAQ')

@section('content')
<div class="container my-5">
    <div class="bg-gray-100 py-10">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-semibold text-center text-gray-800">Frequently Asked Questions (FAQs)</h2>
    
    <!-- Booking Section -->
    <div class="mt-8">
      <h3 class="text-xl font-medium text-gray-800">Booking</h3>
      <div class="space-y-4 mt-4">

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('booking1')">
            <span class="font-medium">How far in advance can I make a booking?</span>
          </button>
          <div id="booking1" class="text-gray-600 hidden mt-2">
            You can purchase the bus ticket up to 28 days in advance, depending on the bus operators.
          </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('booking2')">
            <span class="font-medium">Can I change the departure date and time of my confirmed ticket?</span>
          </button>
          <div id="booking2" class="text-gray-600 hidden mt-2">
            Please contact our Customer Support Team at least 48 hours prior to your original departure date and time. Changes are subject to availability and depend on the terms and conditions of bus operators.
          </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('booking3')">
            <span class="font-medium">Can I reschedule my booking to a different route?</span>
          </button>
          <div id="booking3" class="text-gray-600 hidden mt-2">
            Rescheduling to a different route is possible. Please contact our support team for assistance, and be aware of potential extra charges.
          </div>
        </div>

      </div>
    </div>

    <!-- Payment Section -->
    <div class="mt-8">
      <h3 class="text-xl font-medium text-gray-800">Payment</h3>
      <div class="space-y-4 mt-4">

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('payment1')">
            <span class="font-medium">How do I make sure about the payment details and booking confirmation status?</span>
          </button>
          <div id="payment1" class="text-gray-600 hidden mt-2">
            You’ll receive a confirmation email or SMS depending on the info you provided as the guest information after the booking is confirmed.
          </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('payment2')">
            <span class="font-medium">What payment methods are accepted?</span>
          </button>
          <div id="payment2" class="text-gray-600 hidden mt-2">
            We accept payments via credit card, debit card, mobile payment apps, and online bank transfers.
          </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('payment3')">
            <span class="font-medium">Is it safe to pay online?</span>
          </button>
          <div id="payment3" class="text-gray-600 hidden mt-2">
            Yes, we use secure encryption methods to ensure that all transactions are safe and secure.
          </div>
        </div>

      </div>
    </div>

    <!-- Cancellation Section -->
    <div class="mt-8">
      <h3 class="text-xl font-medium text-gray-800">Cancellation</h3>
      <div class="space-y-4 mt-4">

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('cancellation1')">
            <span class="font-medium">Can I cancel my ticket?</span>
          </button>
          <div id="cancellation1" class="text-gray-600 hidden mt-2">
            Yes, you can cancel your ticket within 24 hours of booking for a full refund. For cancellations made after 24 hours, a cancellation fee may apply.
          </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('cancellation2')">
            <span class="font-medium">How do I request a cancellation?</span>
          </button>
          <div id="cancellation2" class="text-gray-600 hidden mt-2">
            You can request a cancellation by contacting our Customer Support or by using the cancellation option in your booking confirmation email.
          </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('cancellation3')">
            <span class="font-medium">Will I get a refund after cancellation?</span>
          </button>
          <div id="cancellation3" class="text-gray-600 hidden mt-2">
            Refunds will be processed within 7 business days, depending on your payment method.
          </div>
        </div>

      </div>
    </div>

    <!-- Others Section -->
    <div class="mt-8">
      <h3 class="text-xl font-medium text-gray-800">Others</h3>
      <div class="space-y-4 mt-4">

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('others1')">
            <span class="font-medium">Can I bring luggage on the bus?</span>
          </button>
          <div id="others1" class="text-gray-600 hidden mt-2">
            Yes, you can bring a small carry-on bag. Larger items may require an additional fee.
          </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('others2')">
            <span class="font-medium">Do I need to show an ID to board the bus?</span>
          </button>
          <div id="others2" class="text-gray-600 hidden mt-2">
            Yes, passengers are required to present a valid ID at the time of boarding along with the bus ticket.
          </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
          <button class="w-full text-left text-lg text-gray-700 focus:outline-none" onclick="toggleAnswer('others3')">
            <span class="font-medium">Is there Wi-Fi on the bus?</span>
          </button>
          <div id="others3" class="text-gray-600 hidden mt-2">
            Yes, most of our buses are equipped with free Wi-Fi for passengers.
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  function toggleAnswer(answerId) {
    const answer = document.getElementById(answerId);
    answer.classList.toggle('hidden');
  }
</script>
@endsection