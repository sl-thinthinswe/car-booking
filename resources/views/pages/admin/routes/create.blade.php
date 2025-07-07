@extends('layouts.admin.app')

@section('content')
<div class="container">
  <h2>{{ isset($route) ? 'Edit Route' : 'Create Route' }}</h2>

  <form method="POST" action="{{ isset($route) ? route('admin.routes.update', $route->id) : route('admin.routes.store') }}">
      @csrf
      @if(isset($route)) @method('PUT') @endif

      <div class="form-group mb-3">
          <label>Departure City</label>
          <select name="departure_id" class="form-control" required>
              <option value="">-- Select --</option>
              @foreach($cities as $city)
                  <option value="{{ $city->id }}" {{ (old('departure_id', $route->departure_id ?? '') == $city->id) ? 'selected' : '' }}>
                      {{ $city->name }}
                  </option>
              @endforeach
          </select>
      </div>

      <div class="form-group mb-3">
          <label>Arrival City</label>
          <select name="arrival_id" class="form-control" required>
              <option value="">-- Select --</option>
              @foreach($cities as $city)
                  <option value="{{ $city->id }}" {{ (old('arrival_id', $route->arrival_id ?? '') == $city->id) ? 'selected' : '' }}>
                      {{ $city->name }}
                  </option>
              @endforeach
          </select>
      </div>

      <div class="form-group mb-3">
          <label>Duration (HH:MM)</label>
          <input type="text" name="duration" placeholder="e.g. 01:30" class="form-control" step="60" value="{{ old('duration', $route->duration ?? '') }}" required>
      </div>

      <div class="form-group mb-3">
          <label>Distance (km)</label>
          <input type="number" step="0.1" name="distance_km" class="form-control" value="{{ old('distance_km', $route->distance_km ?? '') }}" required>
      </div>

      <button type="submit" class="btn btn-primary">{{ isset($route) ? 'Update' : 'Create' }} Route</button>
      <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
