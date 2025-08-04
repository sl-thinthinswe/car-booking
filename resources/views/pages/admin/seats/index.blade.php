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
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
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
                        <td class="text-center">{{ $seats->firstItem() + $index }}</td>
                        <td class="text-center">{{ $seat->vehicle->model ?? 'N/A' }} ({{ $seat->vehicle->license_plate ?? 'N/A' }})</td>
                        <td class="text-center">{{ $seat->seat_number }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.seats.edit', $seat->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Delete this seat?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
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
