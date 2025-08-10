@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <h2>{{ isset($vehicle) ? 'Edit Vehicle' : 'Add New Vehicle' }}</h2>

    <form action="{{ isset($vehicle) ? route('admin.vehicles.update', $vehicle->id) : route('admin.vehicles.store') }}" method="POST">
        @csrf
        @if(isset($vehicle))
            @method('PUT')
        @endif

        <div class="form-group mb-3">
            <label for="license_plate">License Plate</label>
            <input 
                type="text" 
                name="license_plate" 
                id="license_plate" 
                class="form-control @error('license_plate') is-invalid @enderror" 
                value="{{ old('license_plate', $vehicle->license_plate ?? '') }}" 
                required
            >
            @error('license_plate')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="model">Model</label>
            <select 
                name="model" 
                id="model" 
                class="form-control @error('model') is-invalid @enderror" 
                required
            >
                <option value="" disabled {{ old('model', $vehicle->model ?? '') == '' ? 'selected' : '' }}>-- Select Model --</option>
                <option value="small_car" {{ old('model', $vehicle->model ?? '') == 'small_car' ? 'selected' : '' }}>Small Car</option>
                <option value="express" {{ old('model', $vehicle->model ?? '') == 'express' ? 'selected' : '' }}>Express</option>
            </select>
            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="seat_count">Seat Count</label>
            <input 
                type="number" 
                name="seat_count" 
                id="seat_count" 
                class="form-control @error('seat_count') is-invalid @enderror" 
                value="{{ old('seat_count', $vehicle->seat_count ?? '') }}" 
                required 
                min="1"
            >
            @error('seat_count')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($vehicle) ? 'Update' : 'Create' }}
        </button>
        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
