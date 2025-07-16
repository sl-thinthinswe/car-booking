@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <h2>Add New City</h2>

    <form action="{{ route('admin.cities.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">City Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter city name" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
