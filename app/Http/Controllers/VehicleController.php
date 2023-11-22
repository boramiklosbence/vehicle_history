<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vehicles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('vehicles.store');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        // get the loss events of the vehicle and order them by date
        $loss_events = $vehicle->loss_events->sortByDesc('date');

        return view('vehicles.show', [
            'vehicle' => $vehicle,
            'loss_events' => $loss_events,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('vehicles.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return view('vehicles.update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return view('vehicles.destroy');
    }
}
