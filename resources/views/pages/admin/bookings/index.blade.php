@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Booking List</h2>
    </div>

    <form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="user" class="form-control" placeholder="Search User"
                       value="{{ request('user') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="trip" class="form-control" placeholder="Search Trip"
                       value="{{ request('trip') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-3 d-flex">
                <button type="submit" class="btn btn-primary me-2">Filter</button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>
    <div class="table-responsive">
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @if($bookings->count() > 0)
        @foreach($bookings as $index => $booking)
        <tr>
            <td>{{ $bookings->firstItem() + $index }}</td>
            <td>{{ $booking->user->name ?? 'N/A' }}</td>
            <td>
                @if ($booking->trip && $booking->trip->route)
                    {{ $booking->trip->route->departure->name ?? 'N/A' }} → 
                    {{ $booking->trip->route->arrival->name ?? 'N/A' }}
                @else
                    N/A
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('Y-m-d H:i') }}</td>
            <td>{{ $booking->number_of_seat }}</td>
            <td>{{ number_format($booking->trip->price_per_seat * $booking->number_of_seat) }}MMK</td>
            <td>
                <span class="badge bg-{{ match($booking->status) {
                    'confirmed' => 'success',
                    'pending' => 'warning',
                    'cancelled' => 'danger',
                } }}">{{ ucfirst($booking->status) }}</span>
            </td>
            <td>
                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-primary">
                    Manage
                </a>
            </td>
        </tr>
    @endforeach    
        @else
            <tr>
                <td colspan="8" class="text-center">No bookings found.</td>
            </tr>
        @endif
        </tbody>
    </table>
    </div>
    <div class="mt-3">
        {{ $bookings->appends(request()->query())->links() }}
    </div>
</div>
@endsection
