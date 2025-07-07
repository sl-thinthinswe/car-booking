@extends('layouts.admin.app')

@section('content')
 <h2>Edit City</h2>
 <form action="{{ route('admin.cities.update', $city) }}" method="POST">
     @csrf @method('PUT')
     <div class="mb-3">
         <label for="name" class="form-label">City Name</label>
         <input type="text" name="name" value="{{ $city->name }}" class="form-control" required>
     </div>
     <button class="btn btn-primary">Update</button>
     <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">Cancel</a>
 </form>
 @endsection
 
