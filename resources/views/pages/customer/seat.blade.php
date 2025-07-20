@extends('layouts.customer.app')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <!-- Left Column - Seat Selection -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Please select 1 Seat(s)</h4>
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
            <!-- Trip Summary Card -->
<div class="card shadow-sm border-start border-3 border-primary mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Trip Summary</h5>
    </div>
    <div class="card-body">

        <!-- From / To -->
        <div class="d-flex flex-column align-items-center mb-3">
           <!-- From / To Route -->
            <li class="list-group-item text-center bg-light">
                <div class="fw-semibold text-primary">Naypyitaw (Bawga) ⇨ Mandalay</div>
            </li>
        </div>

        <!-- Stopovers -->
        <div class="mb-3">
            <div class="fw-bold mb-1">Stopovers</div>
            <ul class="list-unstyled mb-0 ps-3">
                <li class="text-muted">Naypyitaw (Myoma)</li>
            </ul>
        </div>

        <!-- Trip Times -->
        <div class="mb-3">
            <div><strong>Pickup Time:</strong> Jul 15, 06:30 PM</div>
            <div><strong>Departure:</strong> Jul 15, 05:30 PM</div>
            <div><strong>Arrival:</strong> Jul 16, 06:00 AM</div>
            <small class="text-muted d-block mt-2">* Arrival times are estimates and may change.</small>
        </div>

        <hr>

        <!-- Full Itinerary Toggle -->
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

            <!-- From / To Route -->
            <li class="list-group-item text-center bg-light">
                <div class="fw-semibold text-primary">Naypyitaw (Bawga) ⇨ Mandalay</div>
            </li>

            <!-- Ticket Details -->
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
                <span>1 seat</span>
            </li>

            <!-- Total Price Highlighted -->
            <li class="list-group-item d-flex justify-content-between bg-primary text-white fw-bold">
                <span>Total Ticket Price</span>
                <span>MMK 17,000</span>
            </li>
        </ul>
    </div>
</div>


            <!-- Seat Selection Confirmation Box -->
<div id="seatFormBox"
     style="width: 120px; height: 50px; border: 2px dashed #0d6efd; border-radius: 6px; display: flex; align-items: center; justify-content: center; margin: auto; background-color: #f8f9fa;">

    <form id="seatForm"
          action="{{ route('seat') }}"
          method="POST"
          class="w-100 h-100 d-flex align-items-center justify-content-center m-0 p-0">
        @csrf
        <input type="hidden" name="selected_seat" id="selectedSeatInput">
        <span id="seatNumberText" class="fw-bold text-primary small"></span>
    </form>
</div>
<!-- Continue Button -->
            <a href="{{ route('select') }}" class="btn btn-primary w-100 mt-3 py-2">Continue to Traveller Info</a>
        </div>
    </div>
</div>

<script>
    const seatContainer = document.getElementById("seatContainer");
    const seatFormBox = document.getElementById("seatFormBox");
    const seatForm = document.getElementById("seatForm");
    const seatNumberText = document.getElementById("seatNumberText");
    const selectedSeatInput = document.getElementById("selectedSeatInput");

    const totalSeats = 32;
    const seatsPerRow = 4;
    const rowLabels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

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
                document.querySelectorAll('[data-seat]').forEach(s => {
                    s.classList.remove("border-primary", "bg-primary", "text-white");
                    s.classList.add("bg-light");
                });
                this.classList.remove("bg-light");
                this.classList.add("border-primary", "bg-primary", "text-white");

                // Show seat form with selected seat
                seatNumberText.textContent = seatLabel;
                selectedSeatInput.value = seatLabel;
                seatFormBox.classList.remove("d-none");
            });

            row.appendChild(seat);
        }

        seatContainer.appendChild(row);
    }
</script>
@endsection
