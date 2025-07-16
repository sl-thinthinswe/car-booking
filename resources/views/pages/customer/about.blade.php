@extends('layouts.customer.app') <!-- Use your master layout -->

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold mb-4" style="font-size: 2rem; font-style: italic;">
        About Us
    </h2>

    <div class="mb-5">
        <h4 class="fw-semibold mb-3">About SeatSnap Ticket</h4>
        <p class="text-muted">
            SeatSnapTicket is one of the leading bus ticket booking systems in Myanmar. 
            We partner with more than 20 major bus operators and offer online ticketing to over 100 destinations for bus travelers across Myanmar.
        </p>
    </div>

    <div class="mb-5">
        <h4 class="fw-semibold mb-3">Instant Confirmation</h4>
        <p class="text-muted">
            SeatSnapTicket is the only e-commerce platform in Myanmar providing instant confirmation for ticket purchases with major bus operators.
        </p>
    </div>

    <div class="mb-5">
        <h4 class="fw-semibold mb-3">Payment Options</h4>
        <p class="text-muted">
            We accept multiple payment methods including KBZPay, CBPay, Wave Money, and AYA Pay for your convenience.
        </p>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-items-wrapper pb-4 mt-5">
    <div class="container">
        <div class="row justify-content-center gy-4">

            <!-- Phone Contact Card -->
            <div class="col-12 col-md-5 d-flex align-items-center bg-cyan-800 shadow-big rounded p-3" style="width: 300px; height: 125px; margin-right: 150px;">  
                <!-- Logo Image as Circle -->
                <img src="{{ asset('images/phone.jpg') }}" alt="Phone Icon"
                    class="rounded-circle border border-2 border-secondary"
                    style="width: 50px; height: 50px;" />

                <!-- Text & Button -->
                <div class="ms-3">
                    <div class="fw-bold text-white">Please call us at</div>
                    <h5 class="fw-bold mt-2">
                        <a href="tel:09 777 111 811" class="text-decoration-underline text-primary">
                            09 777 111 811
                        </a>
                    </h5>
                </div>
            </div>

            <!-- Messenger Contact Card -->
            <div class="col-12 col-md-5 d-flex align-items-center bg-cyan-800 shadow-big rounded p-3" style="width: 300px; height: 125px;"> 
                <!-- Logo Image as Circle -->
                <img src="{{ asset('images/messenger.jpg') }}" alt="Messenger Icon"
                    class="rounded-circle border border-2 border-secondary"
                    style="width: 50px; height: 50px;" />

                <!-- Text & Button -->
                <div class="ms-3">
                    <div class="fw-bold text-white">We're here to help — Start a chat</div>
                    <a href="#" target="_blank" class="btn btn-outline-primary mt-2">
                        Messenger Chat
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
