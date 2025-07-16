@extends('layouts.admin.app')

@section('content')
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>City List</h2>
        <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add City
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="tabel-responsive">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>City Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($cities as $index => $city)
            <tr>
                <td>{{ $cities->firstItem() + $index }}</td>
                <td>{{ $city->name }}</td>
                <td>
                    <a href="{{ route('admin.cities.edit', $city) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this city?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    {{ $cities->links() }}
</div>
@endsection
