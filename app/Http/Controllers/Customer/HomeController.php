<?php

namespace App\Http\Controllers\Customer;

use App\Models\City;
use App\Models\Trip;
use App\Models\Route;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function showForm()
    {
        $cities = City::all();
        return view('pages.customer.home', compact('cities'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|exists:cities,id',
            'to' => 'required|exists:cities,id|different:from',
            'travel_date' => 'required|date|after_or_equal:today',
            'numberOfSeats' => 'required|integer|min:1|max:4',
            'vehicle_type' => 'nullable|in:express,small',
            'departure_period' => 'nullable|in:anytime,morning,afternoon,evening',
        ]);

        $routes = Route::where('departure_id', $request->from)
            ->where('arrival_id', $request->to)
            ->pluck('id');

        $query = Trip::with('route', 'vehicle')
            ->whereIn('route_id', $routes)
            ->whereDate('departure_time', $request->travel_date);

        // Filter by departure period
        if ($request->filled('departure_period')) {
            switch ($request->departure_period) {
                case 'anytime':
                    $query->whereTime('departure_time', '>=', '00:00:00')
                        ->whereTime('departure_time', '<=', '23:59:59');
                    break;

                case 'morning':
                    $query->whereTime('departure_time', '>=', '00:00:00')
                        ->whereTime('departure_time', '<', '12:00:00');
                    break;

                case 'afternoon':
                    $query->whereTime('departure_time', '>=', '12:00:00')
                        ->whereTime('departure_time', '<', '16:00:00');
                    break;

                case 'evening':
                    $query->whereTime('departure_time', '>=', '16:00:00')
                        ->whereTime('departure_time', '<=', '23:59:59');
                    break;
            }
        }

        // filter by the vehicle model
        $vehicleTypes = [
            'express' => 'Express',
            'small' => 'Small Car',
        ];

        if ($request->filled('vehicle_type') && isset($vehicleTypes[$request->vehicle_type])) {
            $query->whereHas('vehicle', function ($q) use ($vehicleTypes, $request) {
                $q->where('model', $vehicleTypes[$request->vehicle_type]);
            });
        }


        $trips = $query->get();


        $cities = City::all();

        return view('pages.customer.search_results', [
            'trips' => $trips,
            'cities' => $cities,
            'numberOfSeats' => $request->numberOfSeats,
            'vehicle_type' => $request->vehicle_type,
        ]);
    }

    // Display the seat selection page
    public function showSeat(Request $request)
    {
        $trip_id = $request->query('trip_id');
        $numberOfSeats = $request->query('numberOfSeats');

        // Fetch trip with its vehicle and seats (using eager loading)
        $trip = Trip::with('vehicle.seats')->findOrFail($trip_id);
        $seats = $trip->vehicle->seats;  // Fetch all seats for the vehicle
        $unavailableSeats = Booking::where('trip_id', $trip_id)
            ->pluck('number_of_seat')
            ->toArray();  // Get all booked seat numbers for the trip

        return view('pages.customer.seat', compact('trip', 'seats', 'numberOfSeats', 'unavailableSeats'));
    }

    // Store selected seats and process the booking
    public function storeSelection(Request $request)
    {
        // Validate seat selection
        $request->validate([
            'selected_seats' => 'required|array|min:1|max:' . $request->number_of_seats,  // Allow dynamic max seats
            'selected_seats.*' => 'distinct',
            'trip_id' => 'required|exists:trips,id',
        ]);

        // Store the selected seats in the session
        session([
            'selected_seats' => $request->input('selected_seats'),
            'trip_id' => $request->input('trip_id'),
            'number_of_seats' => $request->input('number_of_seats'),
        ]);

        return redirect()->route('traveller.form'); 
 // Redirect to traveller form page
    }



    // Display the traveller info form with selected seats
    public function showTravellerForm()
    {
        $selectedSeats = session('selected_seats');
        $tripId = session('trip_id');
        $numberOfSeats = session('number_of_seats');
    
        if (!$selectedSeats || !$tripId || !$numberOfSeats) {
            return redirect()->route('home')->with('error', 'Please select your trip and seats first.');
        }
    
        $trip = Trip::with(['route.departure', 'route.arrival', 'vehicle'])->findOrFail($tripId);
        $pricePerSeat = $trip->price_per_seat;
        $totalPrice = $pricePerSeat * count($selectedSeats);
    
        $showPaymentModal = session('showPaymentModal', false);
        $currentBookingId = session('current_booking_id', null);
    
        return view('pages.customer.select', compact(
            'selectedSeats', 'trip', 'totalPrice', 'numberOfSeats', 'showPaymentModal', 'currentBookingId'
        ));
    }
}
