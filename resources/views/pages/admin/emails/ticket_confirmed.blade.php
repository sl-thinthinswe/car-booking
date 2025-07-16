<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Ticket Confirmation</h4>
        </div>
        <div class="card-body">
            <p>Dear <strong>{{ $ticket['name'] }}</strong>,</p>

            <p>Your car ticket has been successfully booked. Please find the details below:</p>

            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>From:</strong> {{ $ticket['from'] }}</li>
                <li class="list-group-item"><strong>To:</strong> {{ $ticket['to'] }}</li>
                <li class="list-group-item"><strong>Departure Date:</strong> {{ $ticket['date'] }}</li>
                <li class="list-group-item"><strong>Departure Time:</strong> {{ $ticket['time'] }}</li>
                <li class="list-group-item"><strong>Seats Booked:</strong> {{ $ticket['seat'] }}</li>
                <li class="list-group-item"><strong>Total Amount:</strong> ${{ number_format($ticket['total'], 2) }}</li>
                <li class="list-group-item"><strong>Booking Time:</strong> {{ \Carbon\Carbon::parse($ticket['booking_time'])->format('Y-m-d H:i') }}</li>
            </ul>

            <p class="mb-1">Thank you for choosing our service!</p>
        </div>
    </div>
</div>

