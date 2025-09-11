@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <h2 class="mb-4">Booking Details</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    Booking Summary
                </div>
                <div class="card-body">
                    <p><strong>Booking Time:</strong> 
                        {{ \Carbon\Carbon::parse($booking->booking_time)->format('Y-m-d H:i') }}
                    </p>
                    <p><strong>Seats Booked:</strong> {{ $booking->number_of_seat }}</p>
                    <p><strong>Total Amount:</strong> {{ number_format($booking->trip->price_per_seat * $booking->number_of_seat) }} MMK</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ match($booking->status) {
                            'confirmed' => 'success',
                            'pending' => 'warning',
                            'cancelled' => 'danger',
                        } }}">{{ ucfirst($booking->status) }}</span>
                    </p>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    Customer Info
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $booking->user->name ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $booking->user->email ?? 'N/A' }}</p>
                    <p><strong>Phone:</strong> {{ $booking->user->phone ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Trip Information
        </div>
        <div class="card-body">
            <p>
                <strong>Route:</strong>
                {{ $booking->trip->route->departure->name ?? 'N/A' }} 
                → {{ $booking->trip->route->arrival->name ?? 'N/A' }}
            </p>
            <p><strong>Departure Time:</strong> {{ $booking->trip->departure_time }}</p>
            <p><strong>License Plate:</strong> {{ $booking->trip->vehicle->license_plate ?? 'N/A' }}</p>

        </div>
        
    </div>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary mt-4">← Back to Bookings List</a>
</div>
@endsection