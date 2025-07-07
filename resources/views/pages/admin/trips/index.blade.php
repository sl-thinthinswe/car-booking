@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Trip List</h2>
        <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Trip
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Route</th>
                <th>Vehicle</th>
                <th>Departure Time</th>
                <th>Price per Seat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($trips as $index => $trip)
            <tr>
                <td>{{ $trips->firstItem() + $index }}</td>
                <td>{{ $trip->route->departure->name ?? '' }} → {{ $trip->route->arrival->name ?? '' }}</td>
                <td>{{ $trip->vehicle->model }} ({{ $trip->vehicle->license_plate }})</td>
                <td>{{ $trip->departure_time }}</td>
                <td>${{ number_format($trip->price_per_seat, 2) }}</td>
                <td>
                    <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.trips.destroy', $trip->id) }}" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this trip?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $trips->links() }}
</div>
@endsection
