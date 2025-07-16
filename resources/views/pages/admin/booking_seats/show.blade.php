@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Booking Seat Details</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $bookingSeat->id }}</p>
            <p><strong>Booking ID:</strong> {{ $bookingSeat->booking_id }}</p>
            <p><strong>User:</strong> {{ $bookingSeat->booking->user->name ?? 'N/A' }}</p>
            <p><strong>Seat Number:</strong> {{ $bookingSeat->seat->seat_number ?? 'N/A' }}</p>

            <hr>

            <p><strong>Trip Route:</strong> 
                {{ $bookingSeat->trip->route->departure->name ?? 'N/A' }} 
                → {{ $bookingSeat->trip->route->arrival->name ?? 'N/A' }}
            </p>
            <p><strong>Trip Departure Time:</strong> 
                {{ \Carbon\Carbon::parse($bookingSeat->trip->departure_time)->format('Y-m-d H:i') ?? 'N/A' }}
            </p>
        </div>
    </div>

    <a href="{{ route('admin.booking_seats.index') }}" class="btn btn-secondary">← Back to Booking Seats</a>
</div>
@endsection
