<?php

namespace App\Http\Controllers\Customer;

use App\Models\City;
use App\Models\Trip;
use App\Models\Route;
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
        if ($request->filled('vehicle_type')) {
            $query->whereHas('vehicle', function ($q) use ($request) {
                $q->where('model', $request->vehicle_type);
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
    public function showSeat(Request $request)
    {
        $trip_id = $request->query('trip_id');
        $numberOfSeats = $request->query('numberOfSeats');

        // Fetch the trip along with the vehicle and its seats
        $trip = Trip::with('vehicle.seats')->findOrFail($trip_id);

        // Get all the seats for the selected vehicle
        $seats = $trip->vehicle->seats;

        // Pass the trip and seat data to the view
        return view('pages.customer.seat', compact('trip', 'seats', 'numberOfSeats'));
    }
}
