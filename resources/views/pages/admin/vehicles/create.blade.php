@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Add New Vehicle</h2>

    <form action="{{ route('admin.vehicles.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="license_plate">License Plate</label>
            <input type="text" name="license_plate" class="form-control" value="{{ old('license_plate') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" value="{{ old('model') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="seat_count">Seat Count</label>
            <input type="number" name="seat_count" class="form-control" value="{{ old('seat_count') }}" required min="1">
        </div>

        
        <button type="submit" class="btn btn-primary">{{ isset($trip) ? 'Update' : 'Create' }}</button>
        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
