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
    public function index(){
        $totalBookings = Booking::count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        $totalTrips = Trip::count();
        $availableVehicles = Vehicle::count();
        $totalUsers = User::where('name', '!=', 'Admin')->count();
        $totalRoutes = Route::count();

        return view('pages.admin.index', compact(
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'cancelledBookings',
            'totalTrips',
            'availableVehicles',
            'totalUsers',
            'totalRoutes'
        ));
        
    }
}
