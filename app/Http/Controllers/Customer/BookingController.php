<?php

namespace App\Http\Controllers\Customer;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    // Step 1: Store booking as 'pending' and user info
    public function storePending(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => ['required', 'regex:/^09\d{9}$/'],
            'email' => 'nullable|email',
        ]);

        $selectedSeats = session('selected_seats');
        $tripId = session('trip_id');

        if (!$selectedSeats || !$tripId) {
            return redirect()->route('home')->withErrors('Please select seats before booking.');
        }

        DB::beginTransaction();
        try {
            // Create or update user by phone
            $user = User::updateOrCreate(
                ['phone' => $request->phone],
                ['name' => $request->name, 'email' => $request->email]
            );

            $trip = Trip::with('vehicle')->findOrFail($tripId);

            // Create booking with status pending
            $booking = Booking::create([
                'user_id' => $user->id,
                'trip_id' => $trip->id,
                'number_of_seat' => count($selectedSeats),
                'total_amount' => $trip->price_per_seat * count($selectedSeats),
                'status' => 'pending',
            ]);

            // Find seat records by seat numbers for the vehicle
            $seats = \App\Models\Seat::where('vehicle_id', $trip->vehicle_id)
            ->whereIn('seat_number', $selectedSeats)
            ->get();

            foreach ($seats as $seat) {
            // Attach seat to booking with trip_id in pivot
            $booking->seats()->attach($seat->id, ['trip_id' => $trip->id]);
            }

            DB::commit();

            // Save current booking id in session for payment
            session(['current_booking_id' => $booking->id]);

            // Redirect to payment page
            return redirect()->route('booking.payment', $booking->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Failed to create booking: ' . $e->getMessage());
        }
    }


    // Step 2: Show payment page (choose payment method)
    public function paymentPage(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return redirect()->route('home')->withErrors('Booking already processed.');
        }

        return view('pages.customer.bookings.payment', compact('booking'));
    }

    // Step 3: Confirm payment, generate receipt PDF, update booking status
    public function confirmPayment(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'payment_reference' => 'nullable|string|max:255',
        ]);
    
        if ($booking->status !== 'pending') {
            return back()->withErrors('Booking already processed.');
        }
    
        DB::beginTransaction();
        try {
            $booking->status = 'confirmed';
            $booking->payment_method = $request->payment_method;
            $booking->payment_reference = $request->payment_reference;
            $booking->save();
    
            // Eager load seats and trip
            $booking->load('seats', 'trip');
    
            $pdf = Pdf::loadView('pages.customer.bookings.receipt', compact('booking'));
            $filename = 'receipts/booking_' . $booking->id . '.pdf';
            Storage::disk('public')->put($filename, $pdf->output());
    
            session()->forget(['current_booking_id', 'selected_seats', 'trip_id']);
    
            DB::commit();
    
            return redirect()->route('booking.success', $booking->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Failed to confirm payment: ' . $e->getMessage());
        }
    }
    

    // Step 4: Cancel booking if user cancels on payment page
    public function cancel(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->withErrors('Booking already processed.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        session()->forget('current_booking_id');

        return redirect()->route('home')->with('info', 'Booking cancelled.');
    }

    // Step 5: Show success page with download link to receipt
    public function successPage(Booking $booking)
    {
        if ($booking->status !== 'confirmed') {
            return redirect()->route('home')->withErrors('Booking not confirmed.');
        }

        $receiptUrl = asset('storage/receipts/booking_' . $booking->id . '.pdf');

        return view('pages.customer.bookings.success', compact('booking', 'receiptUrl'));
    }
}
