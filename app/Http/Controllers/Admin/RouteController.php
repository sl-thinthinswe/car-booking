<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::with(['departure', 'arrival'])->paginate(10);  
        return view('pages.admin.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('pages.admin.routes.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'departure_id' => 'required|different:arrival_id|exists:cities,id',
            'arrival_id' => 'required|exists:cities,id',
            'duration' => 'required|date_format:H:i',
            'distance_km' => 'required|numeric|min:0.1',
        ]);
    
        Route::create($request->all());
        return redirect()->route('admin.routes.index')->with('success', 'Route created.');
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
        $route = Route::findOrFail($id);
        $cities = City::all();
        return view('pages.admin.routes.edit', compact('route', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'departure_id' => 'required|different:arrival_id|exists:cities,id',
            'arrival_id' => 'required|exists:cities,id',
            'duration' => 'required',
            'distance_km' => 'required|numeric|min:0.1',
        ]);

        $route = Route::findOrFail($id);
        $route->update($request->all());
        return redirect()->route('admin.routes.index')->with('success', 'Route updated.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Route::findOrFail($id)->delete();
        return redirect()->route('admin.routes.index')->with('success', 'Route deleted.');
    }
}
