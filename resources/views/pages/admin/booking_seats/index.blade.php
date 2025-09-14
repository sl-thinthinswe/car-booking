@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <h2 class="mb-4">Booking Seats</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookingSeats->count() > 0)
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Booking ID</th>
                <th>User</th>
                <th>Seat</th>
                <th>Trip Route</th>
                <th>Trip Departure Time</th>
                <th><i class="bi bi-truck"></i> License Plate</th> <!-- Updated Column with Icon -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookingSeats as $index => $bs)
                <tr>
                    <td>{{ $bookingSeats->firstItem() + $index }}</td>
                    <td>{{ $bs->booking_id }}</td>
                    <td>{{ $bs->booking->user->name ?? 'N/A' }}</td>
                    <td>{{ $bs->seat->seat_number ?? 'N/A' }}</td>
                    <td>
                        {{ $bs->trip->route->departure->name ?? 'N/A' }} 
                        → {{ $bs->trip->route->arrival->name ?? 'N/A' }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($bs->trip->departure_time)->format('Y-m-d H:i') ?? 'N/A' }}</td>
                    <td>{{ $bs->trip->vehicle->license_plate ?? 'N/A' }}</td> <!-- Vehicle License Plate -->
                    <td>
                        <a href="{{ route('admin.booking_seats.show', $bs->id) }}" class="btn btn-sm btn-info">View</a>
                        {{-- <form action="{{ route('admin.booking_seats.destroy', $bs->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this booking seat?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div class="alert alert-info text-center">No booking seats found.</div>
    @endif
    {{ $bookingSeats->links() }} 
</div>
@endsection
