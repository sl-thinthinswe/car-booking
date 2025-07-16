<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trip;
use App\Models\Route;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with(['route', 'vehicle'])->paginate(10);
        return view('pages.admin.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = Route::all();
        $vehicles = Vehicle::all();
        return view('pages.admin.trips.create', compact('routes', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'departure_time' => 'required|date|after_or_equal:now',
            'price_per_seat' => 'required|numeric|min:0',
        ]);
    
        Trip::create($request->all());
    
        return redirect()->route('admin.trips.index')->with('success', 'Trip created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        $routes = Route::all();
        $vehicles = Vehicle::all();
        return view('pages.admin.trips.edit', compact('trip', 'routes', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'departure_time' => 'required|date|after_or_equal:now',
            'price_per_seat' => 'required|numeric|min:0',
        ]);
    
        $trip->update($request->all());
    
        return redirect()->route('admin.trips.index')->with('success', 'Trip updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('admin.trips.index')->with('success', 'Trip deleted successfully.');
    }
}
