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
                    <form method="POST" action="{{ route('admin.bookings.sendEmail', $booking->id) }}" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">
                            📧 Send Confirmation Email to User
                        </button>
                    </form> 
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
        </div>
    </div>

    
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            Manage Booking
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}" class="d-flex align-items-center">
                @csrf
                @method('PATCH')

                <label for="status" class="me-2">Update Status:</label>
                <select name="status" id="status" class="form-select w-auto me-3">
                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary mt-4">← Back to Bookings List</a>
</div>
@endsection