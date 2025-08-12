@extends('layouts.customer.blank')

@section('title', 'Complete Payment')

@section('content')
<style>
    /* General font and base styles */
    body, .payment-overlay {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 16px;
        color: #212529;
    }

    /* modal-like overlay */
    .payment-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        z-index: 1050;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        min-height: 100vh;
    }

    .payment-card {
        width: 100%;
        max-width: 940px;
        border-radius: 0.6rem;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        display: flex;
        background-color: #fff;
    }

    @media (max-width: 767px) {
        .payment-card {
            max-width: 95%;
            flex-direction: column;
        }
        .payment-left, .payment-right {
            flex-basis: 100%;
            border-right: none;
        }
    }

    .payment-left {
        background: #fff;
        padding: 1.5rem 1.75rem;
        border-right: 1px solid #f1f1f1;
        flex: 1.4;
        overflow-y: auto;
    }

    .payment-right {
        background: #f9fbff;
        padding: 1.5rem 1.75rem;
        flex: 1;
        overflow-y: auto;
    }

    /* Headings */
    h5 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
        color: #0d6efd;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h6 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.35rem;
        color: #343a40;
    }

    /* Text muted */
    .text-muted {
        color: #6c757d !important;
        font-size: 0.9rem;
    }

    /* Payment method styles */
    .payment-method {
        border: 1px solid #e6eefc;
        border-radius: 0.45rem;
        padding: 0.8rem 1rem;
        margin-bottom: 0.8rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background-color 0.15s ease-out, box-shadow 0.15s ease-out;
        font-size: 1rem;
        font-weight: 600;
        color: #212529;
    }

    .payment-method:hover {
        background-color: #e9f0ff;
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
    }

    .payment-method input {
        margin-right: 1rem;
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    /* Reference label and input */
    label.form-label.small {
        display: block;
        font-size: 1rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.3rem;
    }

    input.form-control {
        font-size: 1rem;
        padding: 0.55rem 0.75rem;
        border-radius: 0.45rem;
        border: 1px solid #ced4da;
        width: 100%;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    input.form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        outline: none;
    }

    /* Buttons */
    .d-grid {
        display: grid;
        gap: 0.75rem;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
        color: #fff;
        border-radius: 0.45rem;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 0.65rem 1rem;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-primary:hover:not(:disabled) {
        background-color: #0b5ed7;
    }

    .btn-outline-secondary {
        background-color: transparent;
        border: 1.8px solid #6c757d;
        color: #6c757d;
        border-radius: 0.45rem;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.6rem 1rem;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Small helper text below buttons */
    small.d-block.text-muted.mt-3 {
        font-size: 0.875rem;
        text-align: center;
        color: #6c757d;
    }
    #payment_reference {
    margin-bottom: 1rem; /* Adds space below the input */
    }     

    #confirmBtn {
    margin-bottom: 1rem; /* Adds space below Confirm Payment button */
    }

    #cancelForm {
        margin-top: 1rem; /* Extra spacing if needed */
    }


</style>

<div class="payment-overlay" role="dialog" aria-modal="true" aria-labelledby="paymentTitle">
    <div class="payment-card">

        <!-- Left side: Booking summary -->
        <div class="payment-left" aria-label="Booking Summary">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 id="paymentTitle">Complete Payment</h5>
                    <small class="text-muted">Booking {{ $booking->id }} — {{ ucfirst($booking->status) }}</small>
                </div>
            </div>

            <div class="mb-3">
                <h6>Trip</h6>
                <div class="small text-muted">
                    <div><strong>{{ $booking->trip->route->departure->name }}</strong> → <strong>{{ $booking->trip->route->arrival->name }}</strong></div>
                    <div>Departure: {{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('M d, Y - h:i A') }}</div>
                </div>
            </div>

            <div class="mb-3">
                <h6>Seats</h6>
                <div class="small text-muted">
                    {{ session('selected_seats') ? implode(', ', session('selected_seats')) : '—' }}
                </div>
            </div>

            <div class="mb-3">
                <h6>Passenger</h6>
                <div class="small text-muted">
                    {{ $booking->user->name ?? '-' }} • {{ $booking->user->phone ?? '-' }} • {{ $booking->user->email ?? '-' }}
                </div>
            </div>

            <div class="mt-4 p-3 bg-white border">
                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong class="text-primary">{{ number_format($booking->total_amount) }} MMK</strong>
                </div>
            </div>
        </div>

        <!-- Right side: Payment methods -->
        <div class="payment-right" aria-label="Payment Methods">
            <h6 class="mb-3">Choose payment method</h6>

            <form id="confirmForm" method="POST" action="{{ route('booking.confirm', $booking->id) }}">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                <label class="payment-method" for="pay_wave">
                    <input id="pay_wave" type="radio" name="payment_method" value="Wave Money" />
                    <div>
                        <strong>Wave Money</strong>
                        <div class="text-muted">094xxxxxxx</div>
                    </div>
                </label>

                <label class="payment-method" for="pay_kbz">
                    <input id="pay_kbz" type="radio" name="payment_method" value="KBZ Pay" />
                    <div>
                        <strong>KBZ Pay</strong>
                        <div class="text-muted">092xxxxxxx</div>
                    </div>
                </label>

                <label class="payment-method" for="pay_cb">
                    <input id="pay_cb" type="radio" name="payment_method" value="CB Pay" />
                    <div>
                        <strong>CB Pay</strong>
                        <div class="text-muted">097xxxxxxx</div>
                    </div>
                </label>

                <label class="payment-method" for="pay_aya">
                    <input id="pay_aya" type="radio" name="payment_method" value="AYA Pay" />
                    <div>
                        <strong>AYA Pay</strong>
                        <div class="text-muted">095xxxxxxx</div>
                    </div>
                </label>

                <div class="mt-3">
                    <label for="payment_reference" class="form-label small">Reference (optional)</label>
                    <input
                        type="text"
                        class="form-control"
                        id="payment_reference"
                        name="payment_reference"
                        placeholder="Transaction ID / sender phone (optional)"
                    />
                </div>

                <div class="d-grid mt-4">
                    <button id="confirmBtn" type="submit" class="btn btn-primary">Confirm Payment</button>
                </div>
            </form>

            <form id="cancelForm" method="POST" action="{{ route('booking.cancel', $booking->id) }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Cancel & Return Home</button>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    (function () {
        const confirmForm = document.getElementById('confirmForm');
        confirmForm.addEventListener('submit', function (e) {
            const chosen = document.querySelector('input[name="payment_method"]:checked');
            if (!chosen) {
                e.preventDefault();
                alert('Please choose a payment method.');
                return false;
            }
            document.getElementById('confirmBtn').disabled = true;
        });

        const cancelForm = document.getElementById('cancelForm');
        cancelForm.addEventListener('submit', function (e) {
            if (!confirm('Cancel booking and go back to home?')) {
                e.preventDefault();
            }
        });
    })();
</script>
@endpush

@endsection
