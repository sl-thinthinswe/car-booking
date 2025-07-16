@extends('layouts.admin.app')

@section('content')
<div class="row g-4">

    <div class="col-md-3">
        <div class="card bg-body-secondary border-0 rounded-3 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Bookings</h6>
                <p class="fs-3 fw-semibold text-primary">{{ $totalBookings }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-body-secondary border-0 rounded-3 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Confirmed Bookings</h6>
                <p class="fs-3 fw-semibold text-success">{{ $confirmedBookings }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-body-secondary border-0 rounded-3 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Pending Bookings</h6>
                <p class="fs-3 fw-semibold text-warning">{{ $pendingBookings }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-body-secondary border-0 rounded-3 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Cancelled Bookings</h6>
                <p class="fs-3 fw-semibold text-danger">{{ $cancelledBookings }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-body-secondary border-0 rounded-3 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Trips</h6>
                <p class="fs-3 fw-semibold text-dark">{{ $totalTrips }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-body-secondary border-0 rounded-3 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Available Vehicles</h6>
                <p class="fs-3 fw-semibold text-info">{{ $availableVehicles }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-body-secondary border-0 rounded-3 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Customers</h6>
                <p class="fs-3 fw-semibold text-dark">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-body-secondary border-0 rounded-3 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Routes</h6>
                <p class="fs-3 fw-semibold text-secondary">{{ $totalRoutes }}</p>
            </div>
        </div>
    </div>

</div>
@endsection
