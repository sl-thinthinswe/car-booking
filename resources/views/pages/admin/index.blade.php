@extends('layouts.admin.app')

@section('content')
<div class="row g-4">
    @php
        $cards = [
            ['label' => 'Total Bookings', 'value' => $totalBookings, 'color' => 'primary', 'icon' => 'bi-journal-bookmark'],
            ['label' => 'Confirmed Bookings', 'value' => $confirmedBookings, 'color' => 'success', 'icon' => 'bi-check-circle'],
            ['label' => 'Pending Bookings', 'value' => $pendingBookings, 'color' => 'warning', 'icon' => 'bi-hourglass-split'],
            ['label' => 'Cancelled Bookings', 'value' => $cancelledBookings, 'color' => 'danger', 'icon' => 'bi-x-circle'],
            ['label' => 'Total Trips', 'value' => $totalTrips, 'color' => 'dark', 'icon' => 'bi-geo-alt'],
            ['label' => 'Available Vehicles', 'value' => $availableVehicles, 'color' => 'info', 'icon' => 'bi-truck-front'],
            ['label' => 'Total Customers', 'value' => $totalUsers, 'color' => 'cyan', 'icon' => 'bi-people'],
            ['label' => 'Total Routes', 'value' => $totalRoutes, 'color' => 'secondary', 'icon' => 'bi-signpost']
        ];
    @endphp

    {{-- Metric Cards --}}
    @foreach ($cards as $card)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white d-flex flex-column gap-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="rounded-circle bg-light p-2">
                        <i class="bi {{ $card['icon'] }} fs-4 text-{{ $card['color'] }}"></i>
                    </div>
                    <div class="text-end">
                        <h6 class="text-muted mb-1">{{ $card['label'] }}</h6>
                        <p class="fs-4 fw-semibold text-{{ $card['color'] }} mb-0">{{ $card['value'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Charts Section --}}
<div class="row mt-4 g-4">

    <div class="col-lg-6 mt-4">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 fw-semibold text-dark">Bookings by Route</h5>
                <span class="badge bg-light text-muted">Current Data</span>
            </div>
            <canvas id="bookingsByRouteChart" height="250"></canvas>
        </div>
    </div>
    
    {{-- Booking Overview Chart --}}
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 fw-semibold text-dark">Booking Overview</h5>
                <span class="badge bg-light text-muted">Current Stats</span>
            </div>
            <canvas id="bookingChart" height="250"></canvas>
        </div>
    </div>

</div>
@endsection
