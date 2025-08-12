@extends('layouts.customer.app') 

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold mb-4" style="font-size: 2rem; font-style: italic;">
        About Us
    </h2>

    <!-- About SeatSnap Ticket Section -->
    <div class="mb-5"> 
        <h4 class="fw-semibold mb-3">About SeatSnap Ticket</h4>
        <p class="text-muted">
            SeatSnapTicket is one of the leading bus ticket booking systems in Myanmar. 
            We partner with over 20 major bus operators, offering online ticketing to more than 100 destinations for bus travelers across the country.
        </p>
    </div>

    <!-- Instant Confirmation Section -->
    <div class="mb-5">
        <h4 class="fw-semibold mb-3">Instant Confirmation</h4>
        <p class="text-muted">
            SeatSnapTicket is the first e-commerce platform in Myanmar providing instant confirmation for ticket purchases with major bus operators.
        </p>
    </div>

    <!-- Payment Options Section -->
    <div class="mb-5">
        <h4 class="fw-semibold mb-3">Payment Options</h4>
        <p class="text-muted">
            We accept multiple payment methods including KBZPay, CBPay, Wave Money, and AYA Pay, ensuring that you can pay conveniently and securely.
        </p>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-items-wrapper pb-4 mt-5">
    <div class="container">
        <div class="row justify-content-center gy-4">

            <!-- Phone Contact Panel -->
            <div class="col-12 col-md-5 col-lg-4 d-flex align-items-center shadow rounded p-3 mb-4 mb-md-0"
                 style="max-width: 350px; border-radius: 12px; padding-left: 20px; padding-right: 20px; border: 3px solid #06b6d4;">
                <div class="d-flex flex-column justify-content-center align-items-start">
                    <!-- Panel Title & Button with Logo Beside -->
                    <div class="d-flex align-items-center ms-3 mt-3">
                        <!-- Logo Image as Circle -->
                        <img src="{{ asset('images/phone3.png') }}" alt="Phone Icon"
                             class="rounded-circle"
                             style="width: 50px; height: 50px; margin-right: 10px;" />
                        <div>
                            <div class="fw-bold text-black">Please call us at</div>
                            <h5 class="fw-bold mt-2">
                                <a href="tel:09 666 777 998" class="text-decoration-underline text-black">
                                    09 666 777 998
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Space Between Panels -->
            <div class="col-12 col-md-1 d-none d-md-block"></div> <!-- 20px space for medium screens and up -->

            <!-- Email Contact Panel -->
            <div class="col-12 col-md-5 col-lg-4 d-flex align-items-center shadow rounded p-3 mb-4 mb-md-0"
                 style="max-width: 350px; border-radius: 12px; padding-left: 20px; padding-right: 20px; border: 3px solid #06b6d4;">
                <div class="d-flex flex-column justify-content-center align-items-start">
                    <!-- Panel Title & Button with Logo Beside -->
                    <div class="d-flex align-items-center ms-3 mt-3">
                        <!-- Logo Image as Circle -->
                        <img src="{{ asset('images/email2.jpg') }}" alt="Email Icon"
                             class="rounded-circle"
                             style="width: 50px; height: 50px; margin-right: 10px;" />
                        <div>
                            <div class="fw-bold text-black">Need help? Send us an email</div>
                            <a href="mailto:maymadisoe66@gmail" class="btn btn-outline-black border-2 border-black text-black hover:bg-white hover:text-white mt-2">
                                Email Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

