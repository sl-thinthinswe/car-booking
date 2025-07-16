@extends('layouts.customer.app') <!-- Use your master layout -->

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveller Information | SeatSnap</title>
    
</head>
<body class="bg-light">
    <div class="container py-4">
        

        <div class="row g-4">
            <!-- Left Column - Traveller Form -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    
                    <div class="card-body pt-0">
                        <form class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="name" class="form-label">Traveller Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" required>
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
                                <input type="tel" class="form-control" id="phone" required>
                                
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-muted">(optional)</span></label>
                                <input type="email" class="form-control" id="email">
                                
                            </div>

                            <div class="mb-4">
                                <label for="request" class="form-label">Special Request <span class="text-muted">(optional)</span></label>
                                <textarea class="form-control" id="request" rows="2"></textarea>
                            </div>

                            <button class="btn btn-primary w-100 py-2" type="submit">Continue to Payment</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - Trip Summary -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-start border-primary border-3 mb-3">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Trip Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 pb-2 border-bottom">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" checked disabled>
                                            <label class="form-check-label fw-medium">Naypyitaw (Bawga)</label>
                                        </div>
                                        <small class="text-muted">Origin • Jul 15, 06:30 PM</small>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-2 pb-2 border-bottom">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" checked disabled>
                                            <label class="form-check-label fw-medium">Naypyitaw (Myoma)</label>
                                        </div>
                                        <small class="text-muted">Jul 15, 05:30 PM</small>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" checked disabled>
                                            <label class="form-check-label fw-medium">Mandalay</label>
                                        </div>
                                        <small class="text-muted">Jul 16, 07:00 AM</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="itinerary">
                            <label class="form-check-label" for="itinerary">Full itinerary</label>
                        </div>

                        <small class="text-muted d-block mt-2">* Arrival times are estimates and may change</small>
                    </div>
                </div>

                <div class="card shadow-sm mb-3">
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
                                <span class="fw-bold">MMK 17,000</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm border-start border-warning border-3">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">Notices</h6>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    
    <script>
        // Form validation
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>
@endsection