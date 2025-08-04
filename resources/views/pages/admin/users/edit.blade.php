@extends('layouts.admin.app')

@section('content')
 <h2>Edit User</h2>
 <form action="{{ route('admin.users.update', $user) }}" method="POST">
     @csrf @method('PUT')
     <div class="mb-3">
        <label for="name" class="form-label">User Name</label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" value="{{ $user->email }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" required>
    </div>
     <button class="btn btn-primary">Update</button>
     <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
 </form>
 @endsection
 
