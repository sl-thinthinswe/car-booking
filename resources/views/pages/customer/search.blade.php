@extends('layouts.customer.app')

@section('content')
<div class="container py-4">

    <!-- Travel Type Selector -->
    <div class="d-flex justify-content-right gap-3 mb-4">
        <button id="express_car" class="btn btn-primary px-4 py-2" style="background-color:#0e7490; border:none;">
            Express Car
        </button>
        <button id="small_car" class="btn btn-outline-primary px-4 py-2" style="border-color:#0e7490; color:#0e7490;">
            Small Car
        </button>
    </div>

    <!-- Search Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('faq') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-6 col-md-3">
                        <label for="from" class="form-label fw-semibold">From</label>
                        <select id="from" name="from" class="form-select" required>
                            <option value="Yangon" selected>Yangon</option>
                            <option value="Mandalay">Mandalay</option>
                            <option value="Naypyitaw">Naypyitaw</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-3">
                        <label for="to" class="form-label fw-semibold">To</label>
                        <select id="to" name="to" class="form-select" required>
                            <option value="Aungpan" selected>Aungpan</option>
                            <option value="Taunggyi">Taunggyi</option>
                            <option value="Bagan">Bagan</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-3">
                        <label for="departure_date" class="form-label fw-semibold">Departure Date</label>
                        <input id="departure_date" type="date" name="departure_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="col-6 col-md-2">
                        <label for="seats" class="form-label fw-semibold">Seats</label>
                        <select id="seats" name="seats" class="form-select">
                            <option value="1" selected>1 seat</option>
                            <option value="2">2 seats</option>
                            <option value="3">3 seats</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-1 d-grid">
                        <button id="search_btn" type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Result Summary -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold mb-0">Yangon → Aungpan</h5>
        <div class="text-muted">Jul 04 | Local | 1 Seat | 13 Trips</div>
    </div>
    <hr>

    <!-- Trip Card Template -->
    <div class="card shadow-sm mb-4 border-cyan-900">
        <div class="card-body">
            <div class="row align-items-center">
                <!-- Time and Type -->
                <div class="col-12 col-md-3 text-center text-md-start mb-3 mb-md-0">
                    <h4 class="fw-bold mb-1">04:00 PM</h4>
                    <div class="text-muted">Afternoon</div>
                    <div id="yutong_badge" class="badge cyan-primary mt-2">Yutong Standard</div>
                </div>

                <!-- Route -->
                <div class="col-12 col-md-5">
                    <p class="mb-2 text-truncate" style="max-width: 100%;">
                        Yangon - Pyawbwe - Kalaw - Aungpan - Helboe - Shwe Nyaung - Ayetharya - Taunggyi
                    </p>
                    <div id="time_badges" class="d-flex flex-wrap gap-2">
                        @foreach(['Any Time', '24 Hours', 'Morning', 'Until 12 PM', 'Afternoon', '12 PM ~ 4 PM'] as $tag)
                            <span class="badge cyan-outline">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- Booking Details -->
                <div class="col-12 col-md-4 text-center text-md-end">
                    <button id="choose_seats_btn" class="btn btn-primary mb-2 w-100">Choose Your Seats</button>
                    <small class="d-block text-muted">Departs: Yangon, Jul 04 - 04:00 PM</small>
                    <small class="d-block text-muted">Arrival: Aungpan, Jul 05 - 09:30 AM</small>
                    <small class="d-block text-muted">Duration: 17h 30m</small>
                    <small class="d-block text-muted">NRC</small>
                    <small class="d-block text-muted">Add contact phone numbers</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Time Filter -->
    <div class="mb-4">
        <h6 class="fw-semibold">Evening/Night Trips</h6>
        <p class="text-muted mb-0">After 4 PM</p>
    </div>

    <!-- Second Trip Card -->
    <div class="card shadow-sm mb-4 border-secondary">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-12 col-md-3 text-center text-md-start mb-3 mb-md-0">
                    <h4 class="fw-bold mb-1">05:00 PM</h4>
                    <div class="text-muted">Evening/Night</div>
                    <div class="badge cyan-outline mt-2">Standard</div>
                </div>
                <div class="col-12 col-md-9">
                    Yangon - Pyawbwe - Kalaw - Aungpan - Helboe - Shwe Nyaung - Ayetharya - Taunggyi
                </div>
            </div>
        </div>
    </div>

    <!-- Price and Booking -->
    <div class="card shadow-sm p-3 mb-5 border-cyan-900">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-0">MMK 30,000</h4>
                <small class="text-muted">1 seat × 30,000</small>
            </div>

            <a href="{{ route('seat') }}" class="btn btn-cyan btn-lg px-4">Book Now</a>
        
        </div>
    </div>

</div>

<!-- Travel Type Toggle Script -->
<script>
    const expressBtn = document.getElementById('express_car');
    const smallBtn = document.getElementById('small_car');
    const bookNowBtn = document.getElementById('book_now_btn');
    const searchBtn = document.getElementById('search_btn');
    const chooseSeatsBtn = document.getElementById('choose_seats_btn');
    const timeBadges = document.querySelectorAll('#time_badges .badge');
    const yutongBadge = document.getElementById('yutong_badge');

    function applyPrimaryStyle(btn) {
        btn.classList.add('btn-cyan');
        btn.classList.remove('btn-outline-cyan');
        btn.style.backgroundColor = '#0e7490';
        btn.style.color = 'white';
        btn.style.border = 'none';
    }

    function applyOutlineStyle(btn) {
        btn.classList.remove('btn-cyan');
        btn.classList.add('btn-outline-cyan');
        btn.style.borderColor = '#0e7490';
        btn.style.color = '#0e7490';
        btn.style.backgroundColor = 'transparent';
    }

    function applyPrimaryBadge(badge) {
        badge.classList.add('cyan-primary');
        badge.classList.remove('cyan-outline');
        badge.style.border = 'none';
        badge.style.color = 'white';
        badge.style.backgroundColor = '#0e7490';
    }

    function applyOutlineBadge(badge) {
        badge.classList.remove('cyan-primary');
        badge.classList.add('cyan-outline');
        badge.style.border = '1px solid #0e7490';
        badge.style.color = '#0e7490';
        badge.style.backgroundColor = 'transparent';
    }

    function toggleTravelType(type) {
        if (type === 'express_car') {
            applyPrimaryStyle(expressBtn);
            applyOutlineStyle(smallBtn);

            applyPrimaryStyle(bookNowBtn);
            applyPrimaryStyle(searchBtn);
            applyPrimaryStyle(chooseSeatsBtn);

            timeBadges.forEach(badge => applyPrimaryBadge(badge));
            applyPrimaryBadge(yutongBadge);
        } else {
            applyPrimaryStyle(smallBtn);
            applyOutlineStyle(expressBtn);

            applyOutlineStyle(bookNowBtn);
            applyOutlineStyle(searchBtn);
            applyOutlineStyle(chooseSeatsBtn);

            timeBadges.forEach(badge => applyOutlineBadge(badge));
            applyOutlineBadge(yutongBadge);
        }
    }

    expressBtn.addEventListener('click', () => toggleTravelType('express_car'));
    smallBtn.addEventListener('click', () => toggleTravelType('small_car'));

    // Initialize default active button & styles
    toggleTravelType('express_car');
</script>

<style>
    /* Custom cyan-900 color for borders and background */
    .border-cyan-900 {
        border-color: #0e7490 !important;
    }
    .btn-cyan {
        background-color: #0e7490 !important;
        color: white !important;
        border: none !important;
    }
    .btn-outline-cyan {
        border: 1px solid #0e7490 !important;
        color: #0e7490 !important;
        background-color: transparent !important;
    }
    .cyan-primary {
        background-color: #0e7490 !important;
        color: white !important;
        border-radius: 0.375rem;
        padding: 0.25em 0.6em;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }
    .cyan-outline {
        background-color: transparent !important;
        color: #0e7490 !important;
        border: 1px solid #0e7490 !important;
        border-radius: 0.375rem;
        padding: 0.25em 0.6em;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }
</style>

@endsection
