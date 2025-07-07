<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::paginate(10);
        return view('pages.admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|max:20|unique:vehicles',
            'model' => 'required|string|max:100',
            'seat_count' => 'required|integer|min:1',
        ]);
    
        Vehicle::create($request->all());
    
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created successfully.');
    
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
    public function edit(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('pages.admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'license_plate' => 'required|string|max:20',
            'model' => 'required|string|max:100',
            'seat_count' => 'required|integer|min:1',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'vehicle deleted successfully.');
    }
}
