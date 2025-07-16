@extends('layouts.customer.app')

@section('content')

<!-- FAQ Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Frequently Asked Questions</h2>

    <!-- Accordion for FAQ -->
    <div class="accordion" id="faqAccordion">
        
        <!-- FAQ Item 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What is the process of booking a ticket?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    To book a ticket, simply select your departure and destination cities, choose your departure time, and enter the number of seats. Then, proceed to payment to confirm your booking.
                </div>
            </div>
        </div>

        <!-- FAQ Item 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How can I cancel my booking?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You can cancel your booking by visiting your booking page or by contacting our customer support. Please note that cancellation fees may apply depending on the time of cancellation.
                </div>
            </div>
        </div>

        <!-- FAQ Item 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    What payment methods are accepted?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We accept payments through credit cards, debit cards, and mobile payment systems like PayPal. You can select your preferred payment method during the checkout process.
                </div>
            </div>
        </div>

        <!-- FAQ Item 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    How do I change my seat selection?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    If you need to change your seat selection, you can do so by visiting the "My Bookings" section of your account or by contacting our customer service.
                </div>
            </div>
        </div>

        <!-- FAQ Item 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Can I book tickets for multiple passengers?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, you can book tickets for multiple passengers in one transaction. Simply specify the number of seats during the booking process.
                </div>
            </div>
        </div>

        <!-- FAQ Item 6 (New) -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    What should I do if I need to modify my booking details?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    If you need to modify your booking details, you can either update them via your account on our website or reach out to our customer support team for assistance.
                </div>
            </div>
        </div>

        <!-- FAQ Item 7 (New) -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    How do I make a payment for my ticket?
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Once you've completed your booking details, you'll be redirected to a secure payment page. You can choose your preferred payment method (credit card, debit card, or mobile payment) to complete the transaction.
                </div>
            </div>
        </div>

        <!-- FAQ Item 8 (New) -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    Can I get a refund if I cancel my booking?
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, depending on the cancellation policy, you may be eligible for a partial refund. If your cancellation is within the allowed time frame, we will refund the ticket price, minus any applicable fees.
                </div>
            </div>
        </div>

        <!-- FAQ Item 9 (New) -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    How do I know if my booking was successful?
                </button>
            </h2>
            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Once your payment is processed successfully, you will receive a confirmation email with your booking details, including a ticket number and seat information. You can also check your booking status in the "My Bookings" section.
                </div>
            </div>
        </div>

    </div>
</div>




@endsection
