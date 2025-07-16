@extends('layouts.admin.app')

@section('content')
    <h2>Edit Trip</h2>
    <form method="POST" action="{{ route('admin.trips.update', $trip->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label for="route_id">Route</label>
        <select name="route_id" class="form-control @error('route_id') is-invalid @enderror" required>
            <option value="">-- Select Route --</option>
            @foreach($routes as $route)
                <option value="{{ $route->id }}"
                    {{ old('route_id', $trip->route_id) == $route->id ? 'selected' : '' }}>
                    {{ $route->departure->name ?? 'Unknown' }} → {{ $route->arrival->name ?? 'Unknown' }}
                </option>
            @endforeach
        </select>
        @error('route_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group mb-3">
        <label for="vehicle_id">Vehicle</label>
        <select name="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror" required>
            <option value="">-- Select Vehicle --</option>
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}"
                    {{ old('vehicle_id', $trip->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                    {{ $vehicle->model }} ({{ $vehicle->license_plate }})
                </option>
            @endforeach
        </select>
        @error('vehicle_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group mb-3">
        <label for="departure_time">Departure Time</label>
        <input type="datetime-local"
               name="departure_time"
               class="form-control @error('departure_time') is-invalid @enderror"
               value="{{ old('departure_time', \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d\TH:i')) }}"
               required>
        @error('departure_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-group mb-3">
        <label for="price_per_seat">Price per Seat (MMK)</label>
        <input type="number"
               step="0.01"
               name="price_per_seat"
               class="form-control @error('price_per_seat') is-invalid @enderror"
               value="{{ old('price_per_seat', $trip->price_per_seat) }}"
               required>
        @error('price_per_seat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Trip</button>
    <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary">Cancel</a>
</form>
 @endsection
 
