@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Vehicle List</h2>
        <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Vehicle
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>License Plate</th>
                    <th>Model</th>
                    <th>Seat Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($vehicles->count())
                    @foreach($vehicles as $index => $vehicle)
                        <tr>
                            <td>{{ $vehicles->firstItem() + $index }}</td>
                            <td>{{ $vehicle->license_plate }}</td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->seat_count }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No vehicles found.</td>
                    </tr>
                @endif        
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $vehicles->links() }}
    </div>
</div>
@endsection
