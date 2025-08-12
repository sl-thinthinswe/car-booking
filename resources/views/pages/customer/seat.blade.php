@extends('layouts.customer.app')

@section('content')
<div class="container mt-5">
    <div class="row g-4">
        <!-- Left Column -->
        <div class="col-lg-8">
            <form action="{{ route('select') }}" method="POST" id="submitSeatForm" class="card shadow-sm">
                @csrf
                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                <input type="hidden" name="number_of_seats" value="{{ $numberOfSeats }}">

                <div class="card-header bg-white">
                    <h4 class="mb-0">Please select up to {{ $numberOfSeats }} Seat{{ $numberOfSeats > 1 ? 's' : '' }}</h4>
                </div>
                <div class="card-body">
                    <div class="overflow-auto" style="max-width: 100%;">
                        <div id="seatContainer" class="seat-grid">
                            <!-- Driver Layout (Fixed at front of the seat grid) -->
                            <div class="seat-row d-flex gap-3 mb-3 justify-content-center driver-rectangle">
                                <div class="seat-box driver-seat">
                                    <div class="seat driver">
                                        Driver
                                    </div>
                                </div> 
                            </div>

                            <!-- Passenger Seat Rows -->
                            @php
                                $columns = 4; // fixed columns for layout
                                $rows = ceil($totalPassengerSeats / $columns);
                                $seatCount = 0;
                            @endphp

                            @for ($rowIndex = 0; $rowIndex < $rows; $rowIndex++)
                                <div class="seat-row d-flex gap-4 mb-3 justify-content-center">
                                    @for ($colIndex = 1; $colIndex <= $columns; $colIndex++)
                                        @php
                                            $seatCount++;
                                            if ($seatCount > $totalPassengerSeats) {
                                                break;
                                            }
                                            $seatNumber = chr(65 + $rowIndex) . $colIndex;
                                        @endphp

                                        <div class="seat-box" data-seat="{{ $seatNumber }}"
                                            @if (in_array($seatNumber, $unavailableSeats))
                                                style="pointer-events:none;opacity:0.5;"
                                            @endif>
                                            @if (!in_array($seatNumber, $unavailableSeats))
                                                <div class="seat selectable-seat" tabindex="0" role="checkbox" aria-checked="false"
                                                    aria-label="Seat {{ $seatNumber }}">
                                                    {{ $seatNumber }}
                                                </div>
                                            @else
                                                <div class="seat unavailable-seat text-muted">
                                                    {{ $seatNumber }} 
                                                </div>
                                            @endif
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Hidden inputs for selected seats -->
                    <div id="submitHiddenSelectedSeats"></div>
                </div>
            </form>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Trip Summary -->
            <div class="card shadow-sm border-start border-3 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Trip Summary</h5>
                </div>
                <div class="card-body">
                    <p><strong>From:</strong> {{ $trip->route->departure->name }}</p>
                    <p><strong>To:</strong> {{ $trip->route->arrival->name }}</p>
                    <p><strong>Departure Time:</strong> {{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d h:i A') }}</p>
                    <p><strong>Seat(s):</strong> 
                        @if ($numberOfSeats)
                            {{ $numberOfSeats }} seat{{ $numberOfSeats > 1 ? 's' : '' }}
                        @else
                            Not selected
                        @endif
                    </p>
                </div>
            </div>

            <!-- Ticket Info -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Ticket Information</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center bg-light">
                            <div class="fw-semibold text-black">{{ $trip->route->departure->name }} ⇨ {{ $trip->route->arrival->name }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Operator</span>
                            <span class="fw-medium">SeatSnap</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Car Type</span>
                            <span class="fw-medium">{{ $trip->vehicle->model }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Unit Ticket Price</span>
                            <span>MMK {{ number_format($trip->price_per_seat) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Number of Seats</span>
                            <span id="selectedSeatCount">{{ $numberOfSeats }} seat{{ $numberOfSeats > 1 ? 's' : '' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-cyan-500 text-white fw-bold">
                            <span>Total Ticket Price</span>
                            <span id="totalPrice">MMK {{ number_format($trip->price_per_seat * $numberOfSeats) }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Centered Selected Seats Display -->
                <div class="d-flex justify-content-center my-4">
                    <div id="selectedSeatsDisplay" class="d-flex flex-wrap justify-content-center gap-2"></div>
                </div>

                <!-- Hidden inputs + Submit Button -->
                <div id="submitHiddenSelectedSeats">
                    <button type="submit" form="submitSeatForm" class="btn bg-cyan-500 text-white w-100 mt-3">
                        Continue to Traveller Info
                    </button>
                </div>
            </div>

            <!-- Back Button -->
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-2">
                <a href="javascript:history.back()" class="btn btn-secondary w-100 mt-2 py-2">
                    ← Back to Trip Selection
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.seat-grid {
    display: flex;
    flex-direction: column;
    gap: 20px;
    justify-content: center;
    align-items: center;
}

.seat-row {
    display: flex;
    gap: 18px;
    justify-content: center;
}

.seat-box {
    min-width: 60px;
    user-select: none;
}

.seat {
    border: 1px solid #888;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    background-color: #f8f9fa;
    transition: background-color 0.3s, color 0.3s;
}

.seat.selectable-seat:hover {
    background-color: #e2e6ea;
}

.seat.selected {
    background-color: #0dcaf0;
    color: white;
    border-color: #0dcaf0;
}

.seat.unavailable-seat {
    position: relative;
    background-color: #e9ecef;
    color: #888;
    cursor: not-allowed;
    user-select: none;
    font-weight: bold;
}

/* Single diagonal cross line */
.seat.unavailable-seat::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 1.5px;
    background-color: #999; /* grey line */
    transform: rotate(-45deg);
    transform-origin: center;
    pointer-events: none;
}



.driver-seat {
    width: 300px;
    height: 40px;
    background-color: #6c757d;
}

.driver {
    color: rgb(17, 17, 17);
    text-align: center;
    font-weight: bold;
    padding: 10px;
    border-radius: 5px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

#selectedSeatsDisplay .seat-box {
    padding: 12px 18px;
    font-size: 1.1rem;
    font-weight: 500;
    background-color: #0dcaf0;
    color: white;
    border-radius: 5px;
    text-align: center;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const seatElements = document.querySelectorAll('.seat.selectable-seat');
    const submitHiddenContainer = document.getElementById('submitHiddenSelectedSeats');
    const selectedSeatsDisplay = document.getElementById('selectedSeatsDisplay');
    const maxSeats = {{ $numberOfSeats }};

    function updateSubmitHiddenInputs() {
        // Clear previous inputs and display
        submitHiddenContainer.querySelectorAll('input[name="selected_seats[]"]').forEach(i => i.remove());
        selectedSeatsDisplay.innerHTML = '';

        const selectedSeats = Array.from(seatElements)
            .filter(seat => seat.classList.contains('selected'))
            .map(seat => seat.parentElement.getAttribute('data-seat'));

        selectedSeats.forEach(seatNum => {
            // Add hidden inputs for form submission
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_seats[]';
            input.value = seatNum;
            submitHiddenContainer.appendChild(input);

            // Show selected seat visually
            const seatBox = document.createElement('div');
            seatBox.textContent = seatNum;
            seatBox.classList.add('seat-box');
            selectedSeatsDisplay.appendChild(seatBox);
        });
    }

    function toggleSeatSelection(seatEl) {
        const selectedSeatsCount = document.querySelectorAll('.seat.selected').length;

        if (seatEl.classList.contains('selected')) {
            seatEl.classList.remove('selected');
            seatEl.setAttribute('aria-checked', 'false');
        } else {
            if (selectedSeatsCount >= maxSeats) {
                return; // Max seats reached - do nothing
            }
            seatEl.classList.add('selected');
            seatEl.setAttribute('aria-checked', 'true');
        }
        updateSubmitHiddenInputs();
    }

    seatElements.forEach(seat => {
        seat.addEventListener('click', () => toggleSeatSelection(seat));
        seat.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleSeatSelection(seat);
            }
        });
    });

    // Restore old selected seats if validation failed
    @if(old('selected_seats'))
        const oldSelectedSeats = @json(old('selected_seats'));
        seatElements.forEach(seat => {
            const seatNum = seat.parentElement.getAttribute('data-seat');
            if (oldSelectedSeats.includes(seatNum)) {
                seat.classList.add('selected');
                seat.setAttribute('aria-checked', 'true');
            }
        });
        updateSubmitHiddenInputs();
    @endif
});
</script>

@endsection
