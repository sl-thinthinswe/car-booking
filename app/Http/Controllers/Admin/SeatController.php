<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seat;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seats = Seat::with('vehicle')->paginate(10);
        return view('pages.admin.seats.index', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        return view('pages.admin.seats.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seat_number' => ['required', 'string', 'max:10', 'regex:/^[A-Z]\d+$/i',
            Rule::unique('seats')->where(function ($query) use ($request) {
                return $query->where('vehicle_id', $request->vehicle_id)
                             ->where('seat_number', $request->seat_number);
            }),
        ],
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        $currentSeatCount = $vehicle->seats()->count();

        if ($currentSeatCount >= $vehicle->seat_count) {
            return back()->withErrors(['seat_number' => 'This vehicle already has the maximum number of seats allowed (' . $vehicle->seat_count . ').'])->withInput();
        }

        Seat::create($request->only('vehicle_id', 'seat_number'));

        return redirect()->route('admin.seats.index')->with('success', 'Seat added to vehicle successfully!');
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
    public function edit($id)
    {
        $seat = Seat::findOrFail($id);
        $vehicles = Vehicle::all();
        return view('pages.admin.seats.edit', compact('seat', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $seat = Seat::findOrFail($id);

    $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'seat_number' => [
            'required',
            'string',
            'max:10',
            'regex:/^[A-Z]\d+$/i',
            Rule::unique('seats')->where(function ($query) use ($request) {
                return $query->where('vehicle_id', $request->vehicle_id);
            })->ignore($seat->id),
        ],
    ]);

    $vehicle = Vehicle::findOrFail($request->vehicle_id);
    $seatCount = $vehicle->seats()->where('id', '!=', $seat->id)->count();

    if ($seatCount >= $vehicle->seat_count) {
        return back()->withErrors([
            'seat_number' => 'This vehicle already has the maximum number of seats allowed (' . $vehicle->seat_count . ').',
        ])->withInput();
    }

    $seat->update($request->only('vehicle_id', 'seat_number'));

    return redirect()->route('admin.seats.index')->with('success', 'Seat updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Seat::findOrFail($id)->delete();
        return redirect()->route('admin.seats.index')->with('success', 'Seat deleted successfully.');
    }
}
