@extends('layouts.admin.app')

@section('content')
<div class="row g-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Bookings</h5>
                <p class="card-text fs-4">245</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Active Routes</h5>
                <p class="card-text fs-4">12</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Customers</h5>
                <p class="card-text fs-4">540</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Pending Tickets</h5>
                <p class="card-text fs-4">8</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <h5 class="card-title">Available Vehicles</h5>
                <p class="card-text fs-4">18</p>
            </div>
        </div>
    </div>
</div>
  
@endsection