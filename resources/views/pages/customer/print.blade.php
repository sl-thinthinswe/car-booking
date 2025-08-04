@extends('layouts.customer.app')

@section('content')
<div class="container mt-5 pb-5"> <!-- Added bottom padding -->
    <!-- Logo Section -->
    <div class="text-center mb-4">
        <h2 class="fw-bold mt-2"></h2>
        <p class="text-muted fs-5 fw-semibold">
            Easily retrieve your previous bookings by filling in the form below.
        </p>
    </div>
    <!-- Booking Form Box -->
    <div class="p-4 p-md-3 bg-light card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('faq') }}" method="GET" class="row g-3 justify-content-center"> <!-- Centered form -->
        
                <!-- From -->
                <div class="col-12 col-md-2" style="margin-left: 20px; padding-left: 3px; padding-right: 3px;"> 

                    <div class="input-group">
                        <select name="from" class="form-select" required>
                            <option selected disabled>From</option>
                            <option value="Yangon">Yangon</option>
                            <option value="Mandalay">Mandalay</option>
                        </select>
                    </div>
                </div>

                <!-- To -->
                <div class="col-12 col-md-2"style="padding-left: 3px; padding-right: 3px; margin-left: 20px;"> 
                    <div class="input-group">
                        <select name="to" class="form-select" required>
                            <option selected disabled>To</option>
                            <option value="Mandalay">Mandalay</option>
                            <option value="Bagan">Bagan</option>
                        </select>
                    </div>
                </div>

                <!-- Departure Date -->
                <div class="col-12 col-md-2"style="padding-left: 3px; padding-right: 3px; margin-left: 20px;"> 
                    <input type="date" name="departure_date" class="form-control" required>
                </div>

                <!-- Phone Number -->
                <div class="col-12 col-md-2"style="padding-left: 3px; padding-right: 3px; margin-left: 20px;"> 
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                </div>

                <!-- Submit Button -->
                <div class="col-12 col-md-2"style="padding-left: 3px; padding-right: 3px; margin-left: 20px;"> 
                    <button type="submit" class="btn w-100" style="background-color: #0c27f0; color: white;">
                        Retrieve Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
