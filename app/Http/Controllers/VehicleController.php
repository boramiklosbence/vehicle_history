<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use \App\Models\Vehicle;
use \App\Policies\VehiclePolicy;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){}

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        if (!Auth::check()) {
            return redirect('login');
        }

        // TODO: show this in index view
        if (auth()->user()->cannot('create')) {
            Session::flash('not_admin_user');
            return redirect()->back();
        }

        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){}

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

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
    public function edit(string $id){}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){}
}
