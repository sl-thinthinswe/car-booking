@extends('layouts.customer.app')


@section('content')
<div class="container py-4">
    <div class="row g-4">
        <!-- Left Column - Traveller Form -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Traveller Information</h5>
                </div>
                <div class="card-body pt-0">
                    <form id="travellerForm" action="{{ route('payment') }}"  method="POST" novalidate class="mb-3">
                        
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">Traveller Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Please enter traveller name</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="invalid-feedback">Please select gender</div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                            <div class="invalid-feedback">Please enter phone number</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-muted">(optional)</span></label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="mb-4">
                            <label for="request" class="form-label">Special Request <span class="text-muted">(optional)</span></label>
                            <textarea class="form-control" id="request" name="request" rows="2"></textarea>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-primary w-100 mt-2 py-2" disabled>
                            Proceed to Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column - Trip Summary -->
        <div class="col-lg-4">
            <!-- Trip Summary -->
            <div class="card shadow-sm mb-4 border-start border-3 border-primary">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Trip Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 border-0">
                            <div class="form-check">
                                <input class="form-check-input me-2" type="checkbox" checked disabled>
                                <label class="form-check-label fw-semibold">Naypyitaw (Bawga)</label>
                            </div>
                            <small class="text-muted ms-4">Origin • Jul 15, 06:30 PM</small>
                        </li>
                        <li class="list-group-item px-0 border-0">
                            <div class="form-check">
                                <input class="form-check-input me-2" type="checkbox" checked disabled>
                                <label class="form-check-label fw-semibold">Naypyitaw (Myoma)</label>
                            </div>
                            <small class="text-muted ms-4">Jul 15, 05:30 PM</small>
                        </li>
                        <li class="list-group-item px-0 border-0">
                            <div class="form-check">
                                <input class="form-check-input me-2" type="checkbox" checked disabled>
                                <label class="form-check-label fw-semibold">Mandalay</label>
                            </div>
                            <small class="text-muted ms-4">Jul 16, 07:00 AM</small>
                        </li>
                    </ul>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="itinerary">
                        <label class="form-check-label" for="itinerary">Full itinerary</label>
                    </div>
                    <small class="text-muted d-block mt-2">* Arrival times are estimates and may change.</small>
                </div>
            </div>

            <!-- Pricing Details -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Pricing Details</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Bus Operator</span>
                            <span class="fw-medium">Something Car</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Bus Type</span>
                            <span class="fw-medium">Standard</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Unit Price</span>
                            <span class="fw-medium">MMK 17,000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Seats</span>
                            <span class="fw-medium">1 (No. 32)</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <span class="fw-bold">Total Price</span>
                            <span class="fw-bold text-primary">MMK 17,000</span>
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
        'use strict';
        const form = document.getElementById('travellerForm');
        const submitBtn = document.getElementById('submitBtn');

        const validateForm = () => {
            const name = form.name.value.trim();
            const phone = form.phone.value.trim();
            const gender = form.querySelector('input[name="gender"]:checked');

            if (name && phone && gender) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        };

        form.addEventListener('input', validateForm);
        form.addEventListener('change', validateForm);

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    })();
</script>
@endpush
