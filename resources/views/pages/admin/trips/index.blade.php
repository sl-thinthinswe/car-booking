@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Trip List</h2>
        <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Trip
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
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
                        <td>{{ $trip->route->departure->name ?? 'N/A' }} → {{ $trip->route->arrival->name ?? 'N/A' }}</td>
                        <td>{{ $trip->vehicle->model }} ({{ $trip->vehicle->license_plate }})</td>
                        <td>{{ $trip->departure_time }}</td>
                        <td>{{ number_format($trip->price_per_seat) }} MMK</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.trips.destroy', $trip->id) }}" class="d-inline" onsubmit="return confirm('Delete this trip?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $trips->links() }}
    </div>
</div>
@endsection
