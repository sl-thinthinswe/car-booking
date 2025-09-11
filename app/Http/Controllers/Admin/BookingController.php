<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Booking;
use App\Mail\ConfirmedMail;
use Illuminate\Http\Request;
use App\Mail\CancellationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewBookingNotification;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with([
            'user',
            'trip.route.departure',
            'trip.route.arrival'
        ]);

        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        if ($request->filled('trip')) {
            $query->whereHas('trip.route.departure', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->trip . '%');
            })->orWhereHas('trip.route.arrival', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->trip . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('booking_time', 'desc')->paginate(10);

        return view('pages.admin.bookings.index', compact('bookings'));
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
    // public function store(Request $request)
    // {
    //     // Store code...
    // }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load('user', 'trip.route.departure', 'trip.route.arrival', 'trip.vehicle');
        return view('pages.admin.bookings.show', compact('booking'));
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
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        if ($request->status === 'cancelled') {
            Mail::to($booking->user->email)->send(new CancellationMail($booking->user, 'Booking has been cancelled by admin.'));
        }

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        // Optional: Check if the booking exists before deletion
        if ($booking) {
            // If any additional checks are needed before deletion, handle here

            // Delete the booking
            $booking->delete();

            // Optional: Send an email or notification about the deletion
            // Example: Admin notified or user sent an email about deletion (not necessary)
            // Mail::to($booking->user->email)->send(new CancellationMail($booking->user, 'Your booking has been deleted.'));

            return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
        }

        return redirect()->route('admin.bookings.index')->withErrors('Booking not found.');
    }

    /**
     * Send email confirmation for the booking.
     */
    public function sendEmail($id)
    {
        $booking = Booking::with(['user', 'trip.route.departure', 'trip.route.arrival'])->findOrFail($id);

        if (!$booking->user || !$booking->user->email) {
            return back()->withErrors(['Email address is missing for this user.']);
        }

        $ticket = [
            'name' => $booking->user->name,
            'email' => $booking->user->email,
            'from' => $booking->trip->route->departure->name ?? 'N/A',
            'to' => $booking->trip->route->arrival->name ?? 'N/A',
            'date' => $booking->trip->departure_date ?? now()->format('Y-m-d'),
            'time' => $booking->trip->departure_time,
            'seat' => $booking->number_of_seat,
            'total' => $booking->total_amount,
            'booking_time' => $booking->booking_time,
        ];

        Mail::to($ticket['email'])->send(new ConfirmedMail($ticket));
        $booking->status = 'confirmed';
        $booking->save();
        return back()->with('success', 'Confirmation email sent successfully!');
    }
}
