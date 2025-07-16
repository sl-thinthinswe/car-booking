@extends('layouts.customer.app') <!-- Use your master layout -->

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

                    <!-- Dynamic Seat Layout -->
                    <div id="seatContainer" class="d-flex flex-column align-items-center gap-3">
                        <!-- Rows will be injected by JS -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Trip Summary -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-start border-primary border-3 mb-3">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Trip Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked disabled>
                                <label class="form-check-label">Naypyitaw (Bawga) (Origin)</label>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked disabled>
                                <label class="form-check-label">Naypyitaw (Myoma)</label>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked disabled>
                                <label class="form-check-label">Mandalay</label>
                            </div>
                        </li>
                    </ul>

                    <div class="mb-3">
                        <div>Jul 15, 06:30 PM</div>
                        <div>Jul 15, 05:30 PM</div>
                        <div>Jul 16, 06:00 AM</div>
                        <small class="text-muted">* Arrival times provided are estimates and may be subject to change.</small>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="fullItinerary">
                            <label class="form-check-label" for="fullItinerary">Full Itinerary</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Bus Operator</span>
                            <span> Express</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Bus Type</span>
                            <span>Standard</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Unit Ticket Price</span>
                            <span>MMK 17,000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Number of Seats</span>
                            <span>1 seat</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <span class="fw-bold">Total Ticket Price</span>
                            <span class="fw-bold">MMK 17,000</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm border-start border-warning border-3">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Notices by  Express</h6>
                </div>
                
            </div>

            <a href="#" class="btn btn-primary w-100 mt-3 py-2">Continue to Traveller Info</a>
        </div>
    </div>
</div>

<script>
    const seatContainer = document.getElementById("seatContainer");
    const totalSeats = 32;
    const seatsPerRow = 4; // 2 seats - aisle - 2 seats

    for (let i = 1; i <= totalSeats; i += seatsPerRow) {
        const row = document.createElement("div");
        row.className = "d-flex justify-content-center gap-3";

        for (let j = 0; j < seatsPerRow; j++) {
            const seatNumber = i + j;
            if (seatNumber > totalSeats) break;

            if (j === 2) {
                // Add aisle spacing after 2 seats
                const aisle = document.createElement("div");
                aisle.style.width = "30px";
                row.appendChild(aisle);
            }

            const seat = document.createElement("div");
            seat.textContent = seatNumber;
            seat.className = "border border-2 rounded-3 d-flex align-items-center justify-content-center bg-light";
            seat.style.width = "60px";
            seat.style.height = "60px";
            seat.style.cursor = "pointer";
            seat.dataset.seat = seatNumber;

            // Click event for seat selection
            seat.addEventListener("click", function () {
                // Deselect others
                document.querySelectorAll('[data-seat]').forEach(s => {
                    s.classList.remove("border-primary", "bg-primary", "text-white");
                    s.classList.add("bg-light");
                });
                // Select this
                this.classList.remove("bg-light");
                this.classList.add("border-primary", "bg-primary", "text-white");
            });

            row.appendChild(seat);
        }

        seatContainer.appendChild(row);
    }
</script>
@endsection