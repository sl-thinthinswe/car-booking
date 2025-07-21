@extends('layouts.customer.app')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <!-- Left Column - Seat Selection -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Please select up to 4 Seat(s)</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-4">
                        <div class="border border-2 border-secondary rounded-3 p-3 bg-light">Driver</div>
                    </div>

                    <!-- Seat Layout Container -->
                    <div class="overflow-auto" style="max-width: 100%;">
                        <div id="seatContainer" class="d-flex flex-column align-items-center gap-3">
                            <!-- Seat rows will be injected here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Trip Summary + Seat Confirm Form -->
        <div class="col-lg-4">
            <!-- Trip Summary -->
            <div class="card shadow-sm border-start border-3 border-primary mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Trip Summary</h5>
                </div>
                <div class="card-body">
                    <li class="list-group-item text-center bg-light mb-3">
                        <div class="fw-semibold text-primary">Naypyitaw (Bawga) ⇨ Mandalay</div>
                    </li>
                    <div class="mb-3">
                        <div class="fw-bold mb-1">Stopovers</div>
                        <ul class="list-unstyled mb-0 ps-3">
                            <li class="text-muted">Naypyitaw (Myoma)</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <div><strong>Pickup Time:</strong> Jul 15, 06:30 PM</div>
                        <div><strong>Departure:</strong> Jul 15, 05:30 PM</div>
                        <div><strong>Arrival:</strong> Jul 16, 06:00 AM</div>
                        <small class="text-muted d-block mt-2">* Arrival times are estimates and may change.</small>
                    </div>
                    <hr>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="fullItinerary">
                        <label class="form-check-label" for="fullItinerary">Show full itinerary</label>
                    </div>
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
                            <div class="fw-semibold text-primary">Naypyitaw (Bawga) ⇨ Mandalay</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Bus Operator</span>
                            <span class="fw-medium">Express</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Bus Type</span>
                            <span class="fw-medium">Standard</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Unit Ticket Price</span>
                            <span>MMK 17,000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Number of Seats</span>
                            <span id="selectedSeatCount">0 seat</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-primary text-white fw-bold">
                            <span>Total Ticket Price</span>
                            <span id="totalPrice">MMK 0</span>
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
                             class="seat-box px-3 py-2 bg-light text-primary fw-semibold small"
                             style="min-width: 80px; text-align: center; display: none;"></div>
                        <input type="hidden" name="selected_seats[]" id="seatInput{{ $i }}">
                    @endfor
                </div>
                <button type="submit" id="submitBtn" class="btn btn-primary w-100 mt-2 py-2" disabled>
                    Continue to Traveller Info
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .seat-box {
        border: 2px dotted #0d6efd;
        border-radius: 8px;
    }
</style>

<script>
    const seatContainer = document.getElementById("seatContainer");
    const totalSeats = 32;
    const seatsPerRow = 4;
    const rowLabels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const maxSelection = 4;
    const selectedSeats = [];
    const submitBtn = document.getElementById("submitBtn");

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

        document.getElementById("selectedSeatCount").textContent =
            selectedSeats.length + " seat" + (selectedSeats.length > 1 ? "s" : "");
        document.getElementById("totalPrice").textContent =
            "MMK " + (selectedSeats.length * 17000).toLocaleString();

        // Enable or disable submit button based on seat selection
        submitBtn.disabled = selectedSeats.length === 0;
    }

    for (let i = 0; i < totalSeats / seatsPerRow; i++) {
        const row = document.createElement("div");
        row.className = "d-flex justify-content-center gap-3 flex-wrap";

        for (let j = 0; j < seatsPerRow; j++) {
            const seatIndex = i * seatsPerRow + j;
            if (seatIndex >= totalSeats) break;

            if (j === 2) {
                const aisle = document.createElement("div");
                aisle.style.width = "20px";
                row.appendChild(aisle);
            }

            const seatLabel = rowLabels[i] + (j < 2 ? j + 1 : j);

            const seat = document.createElement("div");
            seat.textContent = seatLabel;
            seat.className = "border border-2 rounded-3 d-flex align-items-center justify-content-center bg-light";
            seat.style.width = "55px";
            seat.style.height = "55px";
            seat.style.cursor = "pointer";
            seat.dataset.seat = seatLabel;

            seat.addEventListener("click", function () {
                const index = selectedSeats.indexOf(seatLabel);

                if (index !== -1) {
                    // Deselect seat
                    selectedSeats.splice(index, 1);
                    seat.classList.remove("bg-primary", "text-white", "border-primary");
                    seat.classList.add("bg-light");
                } else if (selectedSeats.length < maxSelection) {
                    // Select seat
                    selectedSeats.push(seatLabel);
                    seat.classList.remove("bg-light");
                    seat.classList.add("bg-primary", "text-white", "border-primary");
                }

                updateSelectedSeatBoxes();
            });

            row.appendChild(seat);
        }

        seatContainer.appendChild(row);
    }
</script>
@endsection
