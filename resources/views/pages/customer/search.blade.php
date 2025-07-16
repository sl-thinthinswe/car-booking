@extends('layouts.customer.app')

@section('content')
<div class="container py-2">
    <label class="form-label small"></label>
    <div class="d-flex justify-content-right flex-wrap gy-4">
        <!-- Action Buttons -->
<div class="d-grid gap-3 d-md-flex justify-content-md-end mt-4">
    <!-- Back Button with cyan-900 outline -->
<button class="btn bg-cyan-900 text-white">
    Express Car
</button>

<!-- Continue Button with cyan-900 background -->
<button class="btn border border-cyan-900 text-cyan-900 bg-white">
    Small Car
</button>

        
    </div>
</div>


<div class="container py-4">
    <!-- Search Filters Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('faq') }}" method="GET">
                <div class="row g-3 align-items-end">

                    <!-- From -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">From</label>
                        <select name="from" class="form-select" required>
                            <option selected value="Yangon">Yangon</option>
                            <option value="Mandalay">Mandalay</option>
                            <option value="Naypyitaw">Naypyitaw</option>
                        </select>
                    </div>

                    <!-- To -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">To</label>
                        <select name="to" class="form-select" required>
                            <option selected value="Aungpan">Aungpan</option>
                            <option value="Taunggyi">Taunggyi</option>
                            <option value="Bagan">Bagan</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Departure Date</label>
                        <input type="date" name="departure_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Seats -->
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Seats</label>
                        <select name="seats" class="form-select">
                            <option selected value="1">1 seat</option>
                            <option value="2">2 seats</option>
                            <option value="3">3 seats</option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            Search
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Search Results Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Yangon - Aungpan, Jul 04, Local, 1 Seat</h4>
        <div class="text-muted">13 Trips</div>
    </div>

    <hr class="mb-4">

    <!-- Trip Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="mb-1">04:00 PM</h5>
                    <div class="text-muted">Afternoon</div>
                    <div class="fw-medium">Yutong Standard</div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        Yangon-Pyawbwe-Kalaw-Aungpan-Helboe-Shwe Nyaung-Aungthapyar-Ayetharya-Taunggyi
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <span class="badge bg-light text-dark">Any Time</span>
                        <span class="badge bg-light text-dark">24 Hours</span>
                        <span class="badge bg-light text-dark">Morning</span>
                        <span class="badge bg-light text-dark">Until 12 PM</span>
                        <span class="badge bg-light text-dark">Afternoon</span>
                        <span class="badge bg-light text-dark">12 PM ~ 4 PM</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100 mb-2">Choose Your Seats</button>
                    <div class="text-muted small">Yangon Jul 04, 04:00 PM (Departs At)</div>
                    <div class="text-muted small">Aungpan Jul 05, 09:30 AM (Estimated Arrival)</div>
                    <div class="text-muted small">Estimated Duration: 17 Hr 30 Min</div>
                    <div class="text-muted small">NRC</div>
                    <div class="text-muted small">Add phone numbers that will be easy to contact</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Time Filter -->
    <div class="mb-4">
        <h5 class="mb-3">Evening/Night</h5>
        <p class="text-muted">After 4 PM</p>
    </div>

    <!-- Another Trip Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="mb-1">05:00 PM</h5>
                    <div class="text-muted">Evening/Night</div>
                    <div class="fw-medium">Standard</div>
                </div>
                <div class="col-md-9">
                    <div>Yangon-Pyawbwe-Kalaw-Aungpan-Helboe-Shwe Nyaung-Ayetharya-Taunggyi</div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Price Summary -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="mb-0">MMK 30,000</h5>
                    <div class="text-muted">1 seat x 30,000</div>
                </div>
                <button class="btn btn-primary">Book Now</button>
            </div>
        </div>
    </div>



<script>
    // Custom radio button behavior
    document.getElementById('express_car')?.addEventListener('click', () => toggleTravelType('express_car'));
    document.getElementById('small_car')?.addEventListener('click', () => toggleTravelType('small_car'));

    function toggleTravelType(selectedType) {
        const expressCarBtn = document.getElementById('express_car');
        const smallCarBtn = document.getElementById('small_car');

        expressCarBtn.classList.remove('active');
        smallCarBtn.classList.remove('active');

        if (selectedType === 'express_car') {
            expressCarBtn.classList.add('active');
        } else {
            smallCarBtn.classList.add('active');
        }
    }
</script>
@endsection

