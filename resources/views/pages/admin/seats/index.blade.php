@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Seats List</h2>
        <a href="{{ route('admin.seats.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Seat
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Vehicle</th>
                <th>Seat Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($seats as $index => $seat)
            <tr>
                <td>{{ $seats->firstItem() + $index }}</td>
                <td>{{ $seat->vehicle->model ?? 'N/A' }} ({{ $seat->vehicle->license_plate ?? 'N/A' }})</td>
                <td>{{ $seat->seat_number }}</td>
                <td>
                    <a href="{{ route('admin.seats.edit', $seat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this seat?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    {{ $seats->links() }}
</div>
@endsection
