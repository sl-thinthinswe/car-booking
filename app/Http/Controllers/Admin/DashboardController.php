<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trip;
use App\Models\User;
use App\Models\Route;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $totalBookings = Booking::count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        $totalTrips = Trip::count();
        $availableVehicles = Vehicle::count();
        $totalUsers = User::where('name', '!=', 'Admin')->count();
        $totalRoutes = Route::count();

        // Booking Overview (for doughnut chart)
        $bookingOverview = [
            'confirmed' => $confirmedBookings,
            'pending' => $pendingBookings,
            'cancelled' => $cancelledBookings
        ];

        // Top 5 Most Booked Routes
        $topRoutes = Booking::with('trip.route.departure', 'trip.route.arrival')
            ->get()
            ->filter(fn($b) => $b->trip && $b->trip->route)
            ->groupBy(fn($b) => $b->trip->route->id)
            ->map(fn($b) => count($b))
            ->sortDesc()
            ->take(5);

        $routeLabels = $topRoutes->map(function($count, $routeId) {
            $route = Booking::whereHas('trip.route', fn($q) => $q->where('id', $routeId))
                ->first()
                ->trip
                ->route;
            $from = $route->departure->name ?? 'N/A';
            $to = $route->arrival->name ?? 'N/A';
            return "$from → $to";
        })->values();

        $routeData = $topRoutes->values();

        return view('pages.admin.index', compact(
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'cancelledBookings',
            'totalTrips',
            'availableVehicles',
            'totalUsers',
            'totalRoutes',
            'bookingOverview',
            'routeLabels',
            'routeData'
        ));
    }     
}
