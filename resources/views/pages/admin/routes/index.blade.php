@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Route List</h2>
      <a href="{{ route('admin.routes.create') }}" class="btn btn-primary">
          <i class="bi bi-plus-circle"></i> Add Route
      </a>
  </div>

  @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <table class="table table-bordered">
    <thead>
        <tr>
          <th>ID</th>
          <th>From</th>
          <th>To</th>
          <th>Duration</th>
          <th>Distance(km)</th>
          <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($routes as $index => $route)
            <tr>
              <td>{{ $routes->firstItem() + $index }}</td>
              <td>{{ $route->departure->name }}</td>
              <td>{{ $route->arrival->name }}</td>
              <td>{{ $route->duration }}</td>
              <td>{{ $route->distance_km }}</td>
              <td>
                  <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.routes.destroy', $route->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete route?')">Delete</button>
                    </form>
              </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $routes->links() }}
</div>
@endsection
