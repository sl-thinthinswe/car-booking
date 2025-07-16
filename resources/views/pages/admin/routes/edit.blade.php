@extends('layouts.admin.app')

@section('content')
<form method="POST" action="{{ route('admin.routes.update', $route->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label for="departure_id">Departure City</label>
        <select name="departure_id" id="departure_id" class="form-control @error('departure_id') is-invalid @enderror" required>
            <option value="">-- Select Departure City --</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ old('departure_id', $route->departure_id) == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
        @error('departure_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="arrival_id">Arrival City</label>
        <select name="arrival_id" id="arrival_id" class="form-control @error('arrival_id') is-invalid @enderror" required>
            <option value="">-- Select Arrival City --</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ old('arrival_id', $route->arrival_id) == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
        @error('arrival_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="duration">Duration (HH:MM)</label>
        <input
            type="time"
            name="duration"
            id="duration"
            class="form-control @error('duration') is-invalid @enderror"
            value="{{ old('duration', $route->duration) }}"
            required
        >
        @error('duration')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="distance_km">Distance (km)</label>
        <input
            type="number"
            step="0.1"
            name="distance_km"
            id="distance_km"
            class="form-control @error('distance_km') is-invalid @enderror"
            value="{{ old('distance_km', $route->distance_km) }}"
            required
        >
        @error('distance_km')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Route</button>
    <a href="{{ route('admin.routes.index') }}" class="btn btn-secondary">Cancel</a>
</form>
 @endsection
 
