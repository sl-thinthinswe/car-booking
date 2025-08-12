<?php

namespace App\Http\Controllers\Customer;

use App\Models\City;
use App\Models\Trip;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

        // Prevent double booking: check if any selected seat is already booked
        $alreadyBookedSeatNumbers = Booking::where('trip_id', $tripId)
            ->where('status', '!=', 'cancelled') // Ignore cancelled bookings
            ->whereHas('seats', function ($query) use ($selectedSeats) {
                $query->whereIn('seat_number', $selectedSeats);
            })
            ->get()
            ->pluck('seats')
            ->flatten()
            ->pluck('seat_number')
            ->unique()
            ->intersect($selectedSeats)
            ->all();

        if (!empty($alreadyBookedSeatNumbers)) {
            return back()->withErrors([
                'selected_seats' => 'Sorry, the following seat(s) are already booked: ' . implode(', ', $alreadyBookedSeatNumbers),
            ])->withInput();
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
        ]);

        if ($booking->status !== 'pending') {
            return back()->withErrors('Booking already processed.');
        }

        DB::beginTransaction();
        try {
            $booking->status = 'confirmed';
            $booking->save();

            // Eager load seats relation here
            $booking->load('seats');

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
    public function showRetrieveForm()
{
    $cities = \App\Models\City::all();
    return view('pages.customer.print', compact('cities'));
}

public function retrieve(Request $request)
{
    $cities = City::all();

    if ($request->isMethod('get') && $request->filled(['from', 'to', 'departure_date', 'name'])) {
        $request->validate([
            'from' => 'required|exists:cities,id',
            'to' => 'required|exists:cities,id|different:from',
            'departure_date' => 'required|date',
            'name' => 'required|string|max:255',
        ]);

        $bookings = Booking::whereHas('trip', function($q) use ($request) {
                $q->whereHas('route', function($routeQuery) use ($request) {
                    $routeQuery->where('departure_id', $request->from)
                               ->where('arrival_id', $request->to);
                })
                ->whereDate('departure_time', $request->departure_date);
            })
            ->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            })
            ->with(['trip.route.departure', 'trip.route.arrival', 'user', 'seats'])
            ->get();

        return view('pages.customer.print', compact('cities', 'bookings'));
    }

    return view('pages.customer.print', compact('cities'));
}
public function receiptPage(Booking $booking)
{
    // Eager load all needed relations
    $booking->load(['user', 'trip.route.departure', 'trip.route.arrival', 'seats']);

    return view('pages.customer.bookings.receipt', compact('booking'));
}

}
