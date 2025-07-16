@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <h2>Add New Seat</h2>

    <form method="POST" action="{{ isset($seat) ? route('admin.seats.update', $seat->id) : route('admin.seats.store') }}">
        @csrf
        @if(isset($seat))
            @method('PUT')
        @endif

        <div class="form-group mb-3">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" id="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror" required>
                <option value="">-- Select Vehicle --</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $seat->vehicle_id ?? '') == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->model }} ({{ $vehicle->license_plate }})
                    </option>
                @endforeach
            </select>
            @error('vehicle_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="seat_number">Seat Number</label>
            <input type="text" name="seat_number" id="seat_number" class="form-control @error('seat_number') is-invalid @enderror"
                value="{{ old('seat_number', $seat->seat_number ?? '') }}" required maxlength="10">
            @error('seat_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($seat) ? 'Update' : 'Create' }}</button>
        <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
