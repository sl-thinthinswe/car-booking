@extends('layouts.customer.app')

@section('content')
<style>
    @media (min-width: 992px) {
        .trip-summary-wrapper {
            padding-left: 300px;
            padding-right: 300px;
        }
    }
</style>

<div class="container py-4 trip-summary-wrapper">

    <!-- Card Container -->
    <div class="card shadow-sm border border-4 rounded-3 mb-4">
        <div class="card-body p-3">

            <!-- Header -->
            <h4 class="fw-bold text-center mb-3">Trip Summary</h4>

            <!-- Route Info -->
            <div class="row text-center mb-3">
                <div class="col-6">
                    <h6 class="fw-semibold mb-0">Departure: Yangon</h6>
                    <small class="text-muted">Jul 17, 07:00 AM</small>
                </div>
                <div class="col-6">
                    <h6 class="fw-semibold mb-0">Arrival: Mandalay</h6>
                    <small class="text-muted">Jul 17, 04:30 PM</small>
                </div>
            </div>

            <small class="text-muted d-block mb-4">* Arrival times are estimates and may be subject to change.</small>

            <!-- Itinerary Checkbox -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="fullItinerary">
                <label class="form-check-label" for="fullItinerary">Full Itinerary</label>
            </div>

            <!-- Car & Ticket Info -->
            <h6 class="fw-bold mb-3">Car & Ticket Details</h6>
            <div class="row small mb-2">
                <div class="col-6 col-md-4">Car Operator:</div>
                <div class="col-6 col-md-8"><strong>SeatSnap Express</strong></div>
            </div>
            <div class="row small mb-2">
                <div class="col-6 col-md-4">Car Type:</div>
                <div class="col-6 col-md-8"><strong>Standard - Scania</strong></div>
            </div>
            <div class="row small mb-2">
                <div class="col-6 col-md-4">Ticket Price (per seat):</div>
                <div class="col-6 col-md-8"><strong>MMK 31,000</strong></div>
            </div>
            <div class="row small mb-2">
                <div class="col-6 col-md-4">Seats Booked:</div>
                <div class="col-6 col-md-8"><strong>1 seat</strong></div>
            </div>
            <div class="row small mb-2">
                <div class="col-6 col-md-4">Seat Number:</div>
                <div class="col-6 col-md-8"><strong>11</strong></div>
            </div>
            <div class="row small mb-3">
                <div class="col-6 col-md-4">Total Price:</div>
                <div class="col-6 col-md-8"><strong>MMK 31,000</strong></div>
            </div>

            <hr>

            <!-- Travel Notices -->
            <h6 class="fw-bold mb-2">Travel Requirements</h6>
            <ul class="small mb-3 ps-3">
                <li>NRC and endorsements from Ward Office & Police Station</li>
                <li>No passengers allowed before 20-Mile checkpoint</li>
                <li>Foreigners must present Immigration Form C</li>
            </ul>

            <hr>

            <!-- Passenger Info -->
            <h6 class="fw-bold mb-3">Passenger Information</h6>
            <div class="row small mb-2">
                <div class="col-6 col-md-4">Full Name:</div>
                <div class="col-6 col-md-8"><strong>maymadi</strong></div>
            </div>
            <div class="row small mb-2">
                <div class="col-6 col-md-4">Contact Number:</div>
                <div class="col-6 col-md-8"><strong>097778888</strong></div>
            </div>
            <div class="row small mb-3">
                <div class="col-6 col-md-4">Email Address:</div>
                <div class="col-6 col-md-8"><strong>ma77@gmail.com</strong></div>
            </div>

            <hr>

            <!-- Special Request -->
            <div class="card-header bg-light fw-bold">
                Special Request to Operator
            </div>

            <div class="card-body border-top px-3 py-2">
                <textarea class="form-control" name="special_request" rows="3" placeholder="Optional request..."></textarea>
            </div>

            <hr class="my-3">

            <!-- Session ID -->
            <div class="text-start px-3">
                <span class="text-muted small">Session ID: <strong>1342088</strong></span>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-end gap-3 mt-4">
        <!-- Back Button -->
        <a href="{{ route('select') }}" class="btn btn-outline-info flex-fill" style="max-width: 120px;">Back</a>

        <!-- Continue to Payment -->
        <a href="{{ route('payment') }}" class="btn btn-info text-white flex-fill" style="max-width: 180px;">
            Continue to Payment
        </a>
    </div>
</div>
@endsection
