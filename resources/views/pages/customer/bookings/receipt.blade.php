<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        h1 { color: #007bff; }
        .details { margin-top: 20px; }
        .details strong { display: inline-block; width: 130px; }
        .footer { margin-top: 50px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <!-- Add the logo for PDF rendering -->
<div style="text-align: center; margin-top: 20px;">
    <img src="{{ public_path('images/bco.png') }}" alt="Logo" style="max-width: 150px;">
</div>
<h2 style="text-align: center; font-size:xl;">Seat Snap</h2>
    <h1>Booking Receipt #{{ $booking->id }}</h1>

    <div class="details">
        <p><strong>Passenger Name:</strong> {{ $booking->user->name ?? '-' }}</p>
        <p><strong>Trip:</strong> {{ $booking->trip->route->departure->name ?? '-' }} → {{ $booking->trip->route->arrival->name ?? '-' }}</p>
        <p><strong>Departure Time:</strong> {{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('M d, Y - h:i A') ?? '-' }}</p>
        <p><strong>Seats:</strong> {{ $booking->seats->pluck('seat_number')->join(', ') ?? '-' }}</p>
        <p><strong>Total Paid:</strong> {{ number_format($booking->total_amount, 2) }} MMK</p>
        <p><strong>Payment Method:</strong> {{ $booking->payment_method ?? '-' }}</p>
        <p><strong>Payment Reference:</strong> {{ $booking->payment_reference ?? 'N/A' }}</p>
        <p><strong>Booking Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('M d, Y - h:i A') }}</p>
    </div>

    <div class="footer">
        <p>Thank you for booking with us!</p>
    </div>
</body>
</html>
