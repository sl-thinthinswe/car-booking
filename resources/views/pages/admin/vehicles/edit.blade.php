@extends('layouts.admin.app')

@section('content')
 <h2>Edit Vehicle</h2>
 <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST">
     @csrf @method('PUT')
     <div class="mb-3">
        <label for="license_plate">License Plate</label>
            <input type="text" name="license_plate" class="form-control" value="{{ old('license_plate', $vehicle->license_plate) }}" required>
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" value="{{ old('model', $vehicle->model) }}" required>
            <label for="seat_count">Seat Count</label>
            <input type="number" name="seat_count" class="form-control" value="{{ old('seat_count', $vehicle->seat_count) }}" required>
        </div>
     </div>
     <button class="btn btn-primary">Update</button>
     <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">Cancel</a>
 </form>
 @endsection
 
