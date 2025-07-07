@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Bookings List</h2>
    </div>
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="user" class="form-control" placeholder="Search User" value="">
            </div>
            <div class="col-md-3">
                <input type="text" name="trip" class="form-control" placeholder="Search Trip" value="">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Trip</th>
                <th>Booking Time</th>
                <th>Seats</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if($bookings->count() > 0)
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                <td>{{ $booking->trip->name ?? 'N/A' }}</td>
                <td>{{ $booking->booking_time }}</td>
                <td>{{ $booking->number_of_seat }}</td>
                <td>${{ number_format($booking->total_amount, 2) }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
            </tr>
        @endforeach
    @else
        <tr><td colspan="7">No bookings found.</td></tr>
    @endif
</tbody>
</table>

{{ $bookings->links() }}
</div>
@endsection
