
@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Booking List</h2>
    </div>

    {{-- 🔍 Filter Form --}}
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="user" class="form-control" placeholder="Search User" value="{{ request('user') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="trip" class="form-control" placeholder="Search Trip" value="{{ request('trip') }}">
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
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-funnel-fill me-1"></i> Filter
                </button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-clockwise me-1"></i> Reset
                </a>
            </div>
        </div>
    </form>

    {{-- 📋 Booking Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th><i class="bi bi-person"></i> User</th>
                    <th><i class="bi bi-map"></i> Trip</th>
                    <th><i class="bi bi-truck"></i> License Plate</th> {{-- ✅ New --}}
                    <th><i class="bi bi-clock"></i> Booking Time</th>
                    <th><i class="bi bi-grid-3x3-gap"></i> Seats</th>
                    <th><i class="bi bi-cash"></i> Total Amount</th>
                    <th><i class="bi bi-info-circle"></i> Status</th>
                    <th><i class="bi bi-gear"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
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
                        <td>{{ $booking->trip->vehicle->license_plate ?? 'N/A' }}</td> {{-- ✅ Show license plate --}}
                        <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('Y-m-d H:i') }}</td>
                        <td>{{ $booking->number_of_seat }}</td>
                        <td>
                            @if($booking->trip && $booking->trip->price_per_seat)
                                {{ number_format($booking->trip->price_per_seat * $booking->number_of_seat) }} MMK
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ match($booking->status) {
                                'confirmed' => 'success',
                                'pending' => 'warning',
                                'cancelled' => 'danger',
                            } }}">{{ ucfirst($booking->status) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-primary" title="Manage">
                                <i class="bi bi-box-arrow-in-right"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>

    {{-- 📄 Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $bookings->appends(request()->query())->links() }}
    </div>
</div>
@endsection
