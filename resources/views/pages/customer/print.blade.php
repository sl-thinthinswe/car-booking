@extends('layouts.customer.app')

@section('content')
<div class="container mt-5 pb-5">
    <!-- Logo Section -->
    <div class="text-center mb-4">
        <h2 class="fw-bold mt-2">Retrieve Booking</h2>
        <p class="text-muted fs-5 fw-semibold">
            Easily retrieve your previous bookings by filling in the form below.
        </p>
    </div>

    <!-- Booking Form Box -->
    <div class="p-4 p-md-3 bg-light card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('booking.retrieve') }}" method="GET" class="row g-3 justify-content-center">

                <!-- From -->
                <div class="col-12 col-md-2">
                    <select name="from" class="form-select" required>
                        <option selected disabled>From</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('from') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- To -->
                <div class="col-12 col-md-2">
                    <select name="to" class="form-select" required>
                        <option selected disabled>To</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('to') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Departure Date -->
                <div class="col-12 col-md-2">
                    <input type="date" name="departure_date" value="{{ request('departure_date') }}" class="form-control" required>
                </div>

                <!-- Name -->
                <div class="col-12 col-md-2">
                    <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Your Name" required>
                </div>

                <!-- Submit Button -->
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn w-100" style="background-color: #06b6d4; color: white;">
                        Retrieve Booking
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Search Results -->
    @if(isset($bookings) && $bookings->count() > 0)
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Search Results</h5>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Name</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Departure Date</th>
                                <th>Seat</th>
                                <th>Status</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                <td>{{ $booking->trip->route->departure->name ?? 'N/A' }}</td>
                                <td>{{ $booking->trip->route->arrival->name ?? 'N/A' }}</td>
                                <td>{{ $booking->trip->departure_time->format('Y-m-d') }}</td>
                                <td>
                                    @if($booking->seats && $booking->seats->count() > 0)
                                        {{ $booking->seats->pluck('seat_number')->join(', ') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ ucfirst($booking->status) }}</td>
                                {{-- <td>
                                    <a href="{{ route('booking.receipt', $booking->id) }}" class="btn btn-sm btn-primary">
                                        Print Ticket
                                    </a>
                                </td> --}}
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @elseif(request()->all())
        <div class="alert alert-warning">
            No bookings found matching your criteria.
        </div>
    @endif
</div>
@endsection
