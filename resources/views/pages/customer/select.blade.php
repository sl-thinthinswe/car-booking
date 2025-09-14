@extends('layouts.customer.app')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <!-- Left Column - Traveller Form -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="travellerForm" action="{{ route('booking.storePending') }}" method="POST" class="mb-3 needs-validation" novalidate>
                        @csrf

                        <!-- Traveller Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Traveller Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Please enter traveller name</div>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input
                                type="tel"
                                class="form-control"
                                id="phone"
                                name="phone"
                                required
                                pattern="09\d{9}"
                                maxlength="11"
                                minlength="11"
                                placeholder="09XXXXXXXXX"
                            >
                            <div class="invalid-feedback">
                                Please enter a valid phone number starting with 09 and 11 digits long.
                            </div>
                        </div>

                        <!-- Email -->
<div class="mb-3">
    <label for="email" class="form-label">
        Email <small class="text-muted">(Optional)</small>
    </label>
    <input 
        type="email" 
        class="form-control" 
        id="email" 
        name="email" 
        placeholder="example@email.com"
    >
    <div class="invalid-feedback">Please enter a valid email address.</div>
</div>


                        <!-- Special Request -->
                        <div class="mb-4">
                            <label for="request" class="form-label">Special Request</label>
                            <textarea class="form-control" id="request" name="request" rows="2"></textarea>
                        </div>

                        <!-- Proceed to Payment Button -->
                        <button type="submit" class="btn bg-cyan-500 w-100 mt-2 py-2">
                            Proceed to Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column - Trip Summary and Pricing -->
        <div class="col-lg-4">
            <!-- Trip Summary Card -->
            <div class="card shadow-sm mb-4 border-start border-3 border-primary">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Trip Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 border-0">
                            <div class="form-check">
                                <input class="form-check-input me-2" type="checkbox" checked disabled>
                                <label class="form-check-label fw-semibold">{{ $trip->route->departure->name }}</label>
                            </div>
                            <small class="text-muted ms-4">Origin • {{ \Carbon\Carbon::parse($trip->departure_time)->format('M d, h:i A') }}</small>
                        </li>
                        <li class="list-group-item px-0 border-0">
                            <div class="form-check">
                                <input class="form-check-input me-2" type="checkbox" checked disabled>
                                <label class="form-check-label fw-semibold">{{ $trip->route->arrival->name }}</label>
                            </div>
                            <small class="text-muted ms-4">Arrival estimate depends on route</small>
                        </li>
                    </ul>
                    <small class="text-muted d-block mt-2">* Arrival times are estimates and may change.</small>
                </div>
            </div>

            <!-- Pricing Details Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Pricing Details</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Car Operator</span>
                            <span class="fw-medium">SeatSnap</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Car Type</span>
                            <span class="fw-medium">{{ $trip->vehicle->model }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Unit Price</span>
                            <span class="fw-medium">{{ number_format($trip->price_per_seat) }} MMK</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Seat Number</span>
                            <span class="fw-medium">(No. {{ implode(', ', session('selected_seats', [])) }})</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>No. of Seats</span>
                            <span class="fw-medium">{{ count(session('selected_seats', [])) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <span class="fw-bold">Total Price</span>
                            <span class="fw-bold text-primary">
                                {{ number_format($trip->price_per_seat * count(session('selected_seats', []))) }} MMK
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Notices -->
            <div class="card shadow-sm border-start border-3 border-warning">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Notices</h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-0">
                        • Please arrive at the departure point 30 minutes before departure time.<br>
                        • Bring your booking reference for boarding.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (() => {
        const form = document.getElementById('travellerForm');

        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    })();
</script>
@endpush
