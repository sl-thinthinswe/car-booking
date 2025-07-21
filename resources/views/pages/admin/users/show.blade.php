@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">
            Customer Info
        </div>
            
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
        </div>
    </div>
        
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">
            Previous Booking Info
        </div>
            
        <div class="card-body">
            @if ($user->bookings->count())
                @foreach ($user->bookings as $booking)
                    <div class="mb-3 pb-2">
                        <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
                        <p><strong>Trip:</strong> {{ $booking->trip->route->departure->name ?? 'N/A' }} 
                                                → {{ $booking->trip->route->arrival->name ?? 'N/A' }}</p>
                        <p><strong>Duration:</strong> {{ $booking->trip->departure_time }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($booking->status ?? 'N/A') }}</p>
                    </div>
                @endforeach
            @else
                <p>No previous bookings found.</p>
            @endif
        </div>
    </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-dark mt-4">← Back to User List</a>
</div>
@endsection
