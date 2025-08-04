@extends('layouts.customer.app')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <!-- Left Column - Seat Selection -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Please select up to {{ $numberOfSeats }} Seat(s)</h4>
                </div>
                <div class="card-body">
                    <!-- Seat Layout Container -->
                    <div class="overflow-auto" style="max-width: 100%;">
                        <div id="seatContainer" class="seat-grid">
                            <!-- Seat rows will be injected here dynamically -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Trip Summary + Seat Confirm Form -->
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
                    <p><strong>Seat:</strong> {{ $numberOfSeats ?? 'Not selected' }}</p>
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
            </div>

            <!-- Seat Selection Boxes + Form -->
            <form id="seatForm" action="{{ route('select') }}" method="GET" class="mb-3">
                @csrf
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-2">
                    @for($i = 1; $i <= 4; $i++)
                        <div id="seatBox{{ $i }}"
                             class="seat-box px-3 py-2 bg-light text-black fw-semibold small"
                             style="min-width: 80px; text-align: center; display: none; color: black;"></div>
                        <input type="hidden" name="selected_seats[]" id="seatInput{{ $i }}">
                    @endfor
                </div>
                <button type="submit" id="submitBtn" class="btn bg-cyan-500 w-100 mt-2 py-2">
                    Continue to Traveller Info
                </button>
            </form>

            <!-- Back Button under the form -->
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-2">
                <a href="javascript:history.back()" class="btn btn-secondary w-100 mt-2 py-2">
                    ← Back to
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    .seat-box {
        border: 2px dotted #06b6d4; 
        border-radius: 8px;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-align: center;
        transition: all 0.3s ease;
        margin: 2px;
    }
    .bg-cyan-500 {
        background-color: #06b6d4;
    }

    .seat-grid {
        display: grid;
        grid-template-columns: repeat(4, 3cm); 
        gap: 5px;
        margin: 10px;
        justify-items: center;
        align-items: center;
        justify-content: center;  
    }  

    .seat-row {
        display: contents;
    }

    .aisle {
        grid-column: 2 / 3;
        width: 20px;
        height: 60px;
        background-color: #f8f9fa;
    }

    .back-row {
        grid-column: 1 / -1;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 5px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px dashed #eee;
    }

    .driver-area {
        grid-column: 1 / -1;
        text-align: center;
        margin-bottom: 15px;
    }

    .seat-box.selected {
        background-color: #06b6d4;
        color: white;
        border-color: #06b6d4;
        transform: scale(1.05);
        
    }

    .seat-box.unavailable {
        background-color: #e0e0e0;
        color: #999;
        cursor: not-allowed;
        border-color: #ccc;
    }

    .seat-box:hover:not(.unavailable):not(.selected) {
        background-color: #f0f0f0;
    }
</style>

<script>
    const maxSelection = {{ $numberOfSeats ?? 1 }};  
    const selectedSeats = [];
    const submitBtn = document.getElementById("submitBtn");
    const seats = @json($seats);
    const unavailableSeats = @json($unavailableSeats ?? []);

    // Create a seat element
    function createSeatElement(seat) {
        const seatLabel = seat.seat_number;
        const seatElement = document.createElement("div");
        seatElement.textContent = seatLabel;
        seatElement.className = "seat-box";
        seatElement.dataset.seat = seatLabel;

        // Mark unavailable seats
        if (unavailableSeats.includes(seatLabel)) {
            seatElement.classList.add("unavailable");
            return seatElement;
        }

        // Add click event
        seatElement.addEventListener("click", function() {
            const seatIndex = selectedSeats.indexOf(seatLabel);

            if (seatIndex !== -1) {
                // Deselect
                selectedSeats.splice(seatIndex, 1);
                seatElement.classList.remove("selected");
            } else if (selectedSeats.length < maxSelection) {
                // Select
                selectedSeats.push(seatLabel);
                seatElement.classList.add("selected");
            }

            updateSelectedSeatBoxes();
        });

        return seatElement;
    }

    // Render all seats in proper layout (A to Z, 10 rows and 4 columns)
    function renderSeats() {
        const seatContainer = document.getElementById("seatContainer");
        seatContainer.innerHTML = '';

        // Add driver area
        const driverDiv = document.createElement("div");
        driverDiv.className = "driver-area";
        driverDiv.innerHTML = `<div class="border border-2 border-secondary rounded-3 p-3 bg-light d-inline-block">Driver</div>`;
        seatContainer.appendChild(driverDiv);

        // Create rows and seats
        const rowLabels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
        for (let i = 0; i < 10; i++) {
            const rowLabel = rowLabels[i];
            const rowDiv = document.createElement("div");
            rowDiv.className = "seat-row";

            for (let j = 1; j <= 4; j++) {
                const seatNumber = rowLabel + j;
                const seat = seats.find(s => s.seat_number === seatNumber);
                if (seat) {
                    rowDiv.appendChild(createSeatElement(seat));
                }
            }

            seatContainer.appendChild(rowDiv);
        }
    }

    // Update the selected seats display
    function updateSelectedSeatBoxes() {
        for (let i = 1; i <= maxSelection; i++) {
            const box = document.getElementById(`seatBox${i}`);
            const input = document.getElementById(`seatInput${i}`);

            if (selectedSeats[i - 1]) {
                box.textContent = selectedSeats[i - 1];
                input.value = selectedSeats[i - 1];
                box.style.display = 'block';
            } else {
                box.textContent = '';
                input.value = '';
                box.style.display = 'none';
            }
        }

        // Update total price
        const unitPrice = {{ $trip->price_per_seat }};
        const totalPrice = unitPrice * selectedSeats.length;
        document.getElementById('totalPrice').textContent = `MMK ${totalPrice.toLocaleString()}`;

        // Toggle submit button
        submitBtn.disabled = selectedSeats.length !== maxSelection;
        submitBtn.classList.toggle('bg-cyan-500', !submitBtn.disabled);
        submitBtn.classList.toggle('bg-gray-400', submitBtn.disabled);
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        renderSeats();
        updateSelectedSeatBoxes();

        // Form validation
        document.getElementById('seatForm').addEventListener('submit', function(e) {
            if (selectedSeats.length !== maxSelection) {
                e.preventDefault();
                alert(`Please select exactly ${maxSelection} seat${maxSelection > 1 ? 's' : ''} before continuing.`);
            }
        });
    });
</script>
@endsection
