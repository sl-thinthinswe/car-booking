@extends('layouts.customer.app')

@section('title', 'FAQ')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Frequently Asked Questions</h2>

    <!-- Filter Dropdown -->
    <div class="mb-4 text-center">
        <label for="faqFilter" class="form-label fw-bold">Select a Topic:</label>
        <select id="faqFilter" class="form-select w-auto d-inline-block">
            <option value="all">All</option>
            <option value="booking">Booking</option>
            <option value="payment">Payment</option>
            <option value="support">Support</option>
        </select>
    </div>

    <!-- Accordion -->
    <div class="accordion" id="faqAccordion">
        <!-- FAQ ITEM TEMPLATE -->
        @php
            $faqs = [
                ['id' => 'one', 'topic' => 'booking', 'question' => 'What is the process of booking a ticket?', 'answer' => 'Select cities, time, number of seats, then proceed to payment to confirm your booking.'],
                ['id' => 'two', 'topic' => 'support', 'question' => 'How can I cancel my booking?', 'answer' => 'Visit your booking page or contact customer support. Cancellation fees may apply.'],
                ['id' => 'three', 'topic' => 'payment', 'question' => 'What payment methods are accepted?', 'answer' => 'Credit cards, debit cards, and mobile payment systems like PayPal are accepted.'],
                ['id' => 'four', 'topic' => 'booking', 'question' => 'How do I change my seat selection?', 'answer' => 'Go to "My Bookings" or contact support to modify your seat.'],
                ['id' => 'five', 'topic' => 'booking', 'question' => 'Can I book tickets for multiple passengers?', 'answer' => 'Yes, just select the number of seats during the booking process.'],
                ['id' => 'six', 'topic' => 'support', 'question' => 'What should I do if I need to modify my booking details?', 'answer' => 'Update through your account or contact support.'],
                ['id' => 'seven', 'topic' => 'payment', 'question' => 'How do I make a payment for my ticket?', 'answer' => 'After booking, you’ll be redirected to a secure page to complete your payment.'],
                ['id' => 'eight', 'topic' => 'payment', 'question' => 'Can I get a refund if I cancel my booking?', 'answer' => 'Refunds are possible depending on the cancellation time and fee policy.'],
                ['id' => 'nine', 'topic' => 'booking', 'question' => 'How do I know if my booking was successful?', 'answer' => 'You\'ll receive a confirmation email with details and ticket number after payment.']
            ];
        @endphp

        @foreach($faqs as $faq)
        <div class="accordion-item" data-topic="{{ $faq['topic'] }}">
            <h2 class="accordion-header" id="heading{{ $faq['id'] }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $faq['id'] }}" aria-expanded="false"
                        aria-controls="collapse{{ $faq['id'] }}">
                    {{ $faq['question'] }}
                </button>
            </h2>
            <div id="collapse{{ $faq['id'] }}" class="accordion-collapse collapse"
                 aria-labelledby="heading{{ $faq['id'] }}" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {{ $faq['answer'] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- FAQ Filter Script -->
<script>
    document.getElementById('faqFilter').addEventListener('change', function () {
        const selected = this.value;
        const items = document.querySelectorAll('.accordion-item');
        items.forEach(item => {
            if (selected === 'all' || item.dataset.topic === selected) {
                item.classList.remove('d-none');
            } else {
                item.classList.add('d-none');
            }
        });
    });
</script>
@endsection
