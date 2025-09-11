@extends('layouts.customer.blank')

@section('title', 'Booking Successful')

@section('content')
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        color: #333;
        margin: 20px;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        justify-content: center;
    }

    .invoice, .pdf-download {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-sizing: border-box;
        box-shadow: 0 0 10px rgb(0 0 0 / 0.05);
    }

    .invoice {
        flex: 1 1 500px;
        min-width: 320px;
        max-width: 600px;
    }

    .pdf-download {
        flex: 1 1 400px;
        min-width: 320px;
        max-width: 500px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .pdf-download h3 {
        margin-bottom: 20px;
        color: #222;
    }

    .pdf-download a {
        background-color: #1b5164;
        padding: 12px 24px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        border-radius: 6px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-bottom: 20px;
        display: inline-block;
    }

    .pdf-download a:hover {
        background-color: #0a2c36;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header img {
        max-width: 150px;
        margin-bottom: 10px;
        object-fit: contain;
    }

    .header h2 {
        font-weight: 700;
        font-size: 26px;
        color: #222;
        margin: 0;
    }

    .header p {
        color: #555;
        font-size: 13px;
        margin-top: 6px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f7f7f7;
        font-weight: 600;
    }

    tr.total-row td {
        font-weight: 700;
        border-top: 2px solid #222;
        font-size: 16px;
        color: #122b3e;
    }

    .summary {
        max-width: 400px;
        margin-left: auto;
        margin-top: 20px;
    }

    .thank-you {
        text-align: center;
        font-size: 14px;
        color: #777;
        border-top: 1px solid #ddd;
        padding-top: 15px;
        margin-top: 40px;
    }

    .pdf-embed {
        width: 100%;
        height: 480px;
        border: 1px solid #ccc;
        border-radius: 8px;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            gap: 30px;
        }
        .invoice, .pdf-download {
            max-width: 100%;
        }
        .pdf-embed {
            height: 350px;
        }
    }
</style>

<div class="container">
    <!-- Left: Invoice details -->
    <div class="invoice">
        <div class="header">
            {{-- Replace with your logo path or remove --}}
            <img src="{{ asset('images/SeatSnap_BG.png') }}" alt="Logo" />
            <h2>Seat Snap</h2>
            <p>Booking ID: {{ $booking->id }}</p>
            <p>Date: {{ $booking->created_at->format('M d, Y') }}</p>
        </div>

        <table>
            <tr>
                <th>Traveller Name</th>
                <td>{{ $booking->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $booking->user->phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Trip</th>
                <td>{{ $booking->trip->route->departure->name ?? '-' }} to {{ $booking->trip->route->arrival->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Departure</th>
                <td>{{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('M d, Y h:i A') ?? '-' }}</td>
            </tr>
            <tr>
                <th>Seat Numbers</th>
                <td>
                    @if($booking->seats->isNotEmpty())
                        {{ $booking->seats->pluck('seat_number')->implode(', ') }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <th>Number of Seats</th>
                <td>{{ $booking->number_of_seat }}</td>
            </tr>
            {{-- <tr> --}}
                {{-- <th>Payment Method</th> --}}
                {{-- <td>{{ $booking->payment_method ?? 'N/A' }}</td> --}}
            {{-- </tr> --}}
            {{-- <tr> --}}
                {{-- <th>Payment Reference</th> --}}
                {{-- <td>{{ $booking->payment_reference ?? 'N/A' }}</td> --}}
            {{-- </tr> --}}
        </table>

        <table class="summary">
            <tr>
                <th>Total Amount</th>
                <td>{{ number_format($booking->total_amount, 2) }} MMK</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($booking->status) }}</td>
            </tr>
        </table>

        <div style="text-align: right; margin-top: 20px;">
            <button onclick="goHome()" style="
                background-color: #565859;
                color: white;
                border: none;
                padding: 10px 22px;
                border-radius: 6px;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.3s ease;">
             {{-- onmouseover="this.style.backgroundColor='#0a2c36'"
            onmouseout="this.style.backgroundColor='#1b5164'"   --}}
                Back to Home
            </button>
        </div>

        <div class="thank-you">
            Thank you for booking with us!
        </div>
    </div>

    <!-- Right: PDF download and preview -->
    <div class="pdf-download">
        <h3>Booking Receipt PDF</h3>
        <a href="{{ asset('storage/receipts/booking_' . $booking->id . '.pdf') }}" target="_blank" download>
            Download PDF
        </a>

        <embed
            src="{{ asset('storage/receipts/booking_' . $booking->id . '.pdf') }}"
            type="application/pdf"
            class="pdf-embed"
            alt="Booking Receipt PDF" />
    </div>
</div>
<script>
    function goHome(){
        window.location.href="http://127.0.0.1:8000/";
    }
</script>
@endsection
