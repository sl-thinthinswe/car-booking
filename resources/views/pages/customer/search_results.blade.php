@extends('layouts.customer.app')

@section('content')
<div class="container py-4">

    @if(isset($cities))
    <!-- Vehicle Type Selector -->
    <form action="{{ route('trips.search') }}" method="GET" id="search_form">
        <div class="d-flex justify-content-right gap-3 mb-4">
            <!-- Express Car Button -->
            <button type="submit" name="vehicle_type" value="express" 
                id="express_car_btn" class="btn px-4 py-2 {{ (request('vehicle_type') ?? '') == 'express' ? 'bg-cyan-500 text-white' : 'bg-white text-cyan-500 border-cyan-500' }}">
                Express Car
            </button>

            <!-- Small Car Button -->
            <button type="submit" name="vehicle_type" value="small" 
                id="small_car_btn" class="btn px-4 py-2 {{ (request('vehicle_type') ?? '') == 'small' ? 'bg-cyan-500 text-white' : 'bg-white text-cyan-500 border-cyan-500' }}">
                Small Car
            </button>
        </div>

        <!-- Search Form -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <!-- From city -->
                    <div class="col-6 col-md-3">
                        <label for="from" class="form-label fw-semibold">From</label>
                        <select id="from" name="from" class="form-select" required onchange="this.form.submit();">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ request('from') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- To city -->
                    <div class="col-6 col-md-3">
                        <label for="to" class="form-label fw-semibold">To</label>
                        <select id="to" name="to" class="form-select" required onchange="this.form.submit();">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ request('to') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Departure date -->
                    <div class="col-6 col-md-3">
                        <label for="departure_time" class="form-label fw-semibold">Departure Date</label>
                        <input id="travel_date" type="date" name="travel_date" class="form-control"
                            value="{{ request('travel_date', date('Y-m-d')) }}" required onchange="this.form.submit();">
                    </div>

                    <!-- Number of seats -->
                    <div class="col-6 col-md-2">
                        <label for="numberOfSeats" class="form-label fw-semibold">Seats</label>
                        <select id="numberOfSeats" name="numberOfSeats" class="form-select" onchange="this.form.submit();">
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" {{ (string) old('numberOfSeats', request('numberOfSeats')) === (string) $i ? 'selected' : '' }}>
                                    {{ $i }} seat{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-12 col-md-1 d-grid">
                        <button id="search_btn" type="submit" class="btn bg-cyan-500">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Departure Period Table -->
        <div class="row">
            <div class="col-md-3" style="min-height: 100%;">
                <div class="table-responsive" style="min-height: 100%;">
                    <label for="departure_period" class="form-label fw-semibold"></label>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Departure Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 15px 10px;">
                                    <input type="radio" name="departure_period" value="anytime" {{ request('departure_period') == 'anytime' ? 'checked' : '' }} onchange="this.form.submit();">
                                    <span style="margin-left: 10px;">Anytime (24 Hours)</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 10px;">
                                    <input type="radio" name="departure_period" value="morning" {{ request('departure_period') == 'morning' ? 'checked' : '' }} onchange="this.form.submit();">
                                    <span style="margin-left: 10px;">Morning (Until 12 PM)</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 10px;">
                                    <input type="radio" name="departure_period" value="afternoon" {{ request('departure_period') == 'afternoon' ? 'checked' : '' }} onchange="this.form.submit();">
                                    <span style="margin-left: 10px;">Afternoon (12 PM - 4 PM)</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 10px;">
                                    <input type="radio" name="departure_period" value="evening" {{ request('departure_period') == 'evening' ? 'checked' : '' }} onchange="this.form.submit();">
                                    <span style="margin-left: 10px;">Evening/Night (After 4 PM)</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right Column for Available Trips -->
            <div class="col-md-9" style="min-height: 100%;">
                <h5 class="fw-bold mb-3">Available Trips</h5>

                @if($trips->isEmpty())
                    <p class="text-muted">No trips available.</p>
                @else
                    @foreach ($trips as $trip)
                        <div class="card shadow-sm mb-3 border-cyan-900">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <!-- Departure Info -->
                                    <div class="col-md-3 text-center text-md-start mb-2 mb-md-0">
                                        <h4 class="fw-bold">{{ \Carbon\Carbon::parse($trip->departure_time)->format('h:i A') }}</h4>
                                        <div class="text-muted">
                                            {{ ucfirst(\Carbon\Carbon::parse($trip->departure_time)->format('l')) }}
                                        </div>
                                        <span class="badge bg-cyan-500 text-white mt-2">
                                            {{ $trip->vehicle->model ?? 'Standard' }}
                                        </span>
                                    </div>

                                    <!-- Route -->
                                    <div class="col-md-5 text-center">
                                        <p class="mb-1">
                                            <strong>From:</strong> {{ $trip->route->departure->name }}<br>
                                            <strong>To:</strong> {{ $trip->route->arrival->name }}
                                        </p>
                                        <p class="mb-1 text-muted">
                                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d') }}
                                        </p>
                                    </div>

                                    <!-- Booking -->
                                    <div class="col-md-4 text-center text-md-end">
                                        <div class="mb-2">
                                            <span class="fw-bold">Price:</span> MMK {{ number_format($trip->price_per_seat) }}
                                        </div>
                                        <a href="{{ route('seat', ['trip_id' => $trip->id, 'numberOfSeats' => request('numberOfSeats')]) }}" class="btn bg-cyan-500">
                                            Choose Your Seats
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </form>
    @endif
</div>
@endsection
