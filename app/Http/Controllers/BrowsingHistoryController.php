<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use \App\Models\Vehicle;
use \App\Models\BrowsingHistory;

class BrowsingHistoryController extends Controller
{
    private function findVehicleByRegistrationNumber($registrationNumber) {
        foreach (Vehicle::all() as $vehicle) {
            if ($vehicle['registration_number'] === $registrationNumber) {
                return $vehicle;
            }
        }
        return null;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('browsing_histories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('browsing_histories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // check if user is logged in
        if (!Auth::check()) {
            return redirect('login');
        }

        // validate input
        $validated = $request->validate([
            'registration_number' => [
                'required',
                'regex:/^(?:[A-Za-z]{3}-?\d{3}|[A-Za-z]{3}\d{3})$/',
            ]
        ], [
            'registration_number.required' => 'A mező kitöltése kötelező.',
            'registration_number.regex' => 'A megadott rendszám formátuma nem megfelelő.'
        ]);        

        // create a new browsing history
        $browsing_history = BrowsingHistory::factory()->create([
            'searched_registration_number' => $validated['registration_number'],
            'searched_at' => now()->format('Y-m-d'),
        ]);

        // associate the browsing history with the current user
        $browsing_history->user()->associate(Auth::user())->save();

        // check if the vehicle exists
        $vehicle = $this->findVehicleByRegistrationNumber($validated['registration_number']);

        if (isset($vehicle)) {
            return redirect('loss_events');
        }else{
            Session::flash('non_existent_registration_number');
            return redirect('home');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('browsing_histories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('browsing_histories.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return view('browsing_histories.update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return view('browsing_histories.destroy');
    }
}
