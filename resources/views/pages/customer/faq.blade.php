@extends('layouts.customer.app')

@section('content')

<!-- FAQ Section -->
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

       <!-- FAQ Item 1 -->
        <div class="accordion-item" data-topic="booking" id="faq-booking">
<!-- Accordion Wrapper -->
<div class="accordion" id="faqAccordion">

    <!-- FAQ Item -->
    <div class="accordion-item" data-topic="booking" id="faq-booking">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                What is the process of booking a ticket?
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse"
            aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                Select cities, time, number of seats, then proceed to payment to confirm your booking.
            </div>
        </div>
    </div>

</div>

<!-- Auto Expand Script if URL has #faq-booking -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (window.location.hash === "#faq-booking") {
            const collapseEl = document.getElementById("collapseOne");
            const bsCollapse = new bootstrap.Collapse(collapseEl, {
                toggle: true
            });
            // Optional: smooth scroll into view
            document.getElementById("faq-booking")?.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>


        <!-- FAQ Item 2 -->
        <div class="accordion-item" data-topic="support">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How can I cancel my booking?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Visit your booking page or contact customer support. Cancellation fees may apply.
                </div>
            </div>
        </div>

        <!-- FAQ Item 3 -->
        <div class="accordion-item" data-topic="payment">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    What payment methods are accepted?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Credit cards, debit cards, and mobile payment systems like PayPal are accepted.
                </div>
            </div>
        </div>

        <!-- Add more items below -->

        <div class="accordion-item" data-topic="booking">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    How do I change my seat selection?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Go to "My Bookings" or contact support to modify your seat.
                </div>
            </div>
        </div>

        <div class="accordion-item" data-topic="booking">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Can I book tickets for multiple passengers?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, just select the number of seats during the booking process.
                </div>
            </div>
        </div>

        <div class="accordion-item" data-topic="support">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    What should I do if I need to modify my booking details?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Update through your account or contact support.
                </div>
            </div>
        </div>

        <div class="accordion-item" data-topic="payment">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    How do I make a payment for my ticket?
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    After booking, you’ll be redirected to a secure page to complete your payment.
                </div>
            </div>
        </div>

        <div class="accordion-item" data-topic="payment">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    Can I get a refund if I cancel my booking?
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Refunds are possible depending on the cancellation time and fee policy.
                </div>
            </div>
        </div>

        <div class="accordion-item" data-topic="booking">
            <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    How do I know if my booking was successful?
                </button>
            </h2>
            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You'll receive a confirmation email with details and ticket number after payment.
                </div>
            </div>
        </div>

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
