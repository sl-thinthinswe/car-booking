<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\BookingSeat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookingSeats = BookingSeat::with(['booking.user', 'seat', 'trip.route.departure', 'trip.route.arrival'])
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('pages.admin.booking_seats.index', compact('bookingSeats'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'exists:seats,id',
        ]); 

        $booking = Booking::findOrFail($request->booking_id);

        // Custom validation: count of selected seats must match number_of_seat
        if (count($request->seat_ids) != $booking->number_of_seat) {
            return back()->withErrors(['seat_ids' => 'The number of selected seats must match the number of seats in the booking ('.$booking->number_of_seat.').'])->withInput();
        }

        foreach ($request->seat_ids as $seatId) {
            BookingSeat::create([
                'booking_id' => $booking->id,
                'trip_id' => $booking->trip_id,
                'seat_id' => $seatId,
            ]);
        }

        return redirect()->route('admin.booking_seats.index')->with('success', 'Booking seats added successfully.');
    } 

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bookingSeat = BookingSeat::with(['booking.user', 'seat', 'trip.route.departure', 'trip.route.arrival'])
            ->findOrFail($id);

        return view('pages.admin.booking_seats.show', compact('bookingSeat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bookingSeat = BookingSeat::findOrFail($id);
        $bookingSeat->delete();

        return redirect()->route('admin.booking_seats.index')->with('success', 'Booking seat deleted.');
    }
    
}
