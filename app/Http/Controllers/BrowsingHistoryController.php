<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use lluminate\Database\Eloquent\Collection;

use \App\Models\Vehicle;
use \App\Models\BrowsingHistory;

class BrowsingHistoryController extends Controller
{
    private function findVehicleByRegistrationNumber($registrationNumber) {
        return Vehicle::where('registration_number', $registrationNumber)->first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // check if user is logged in
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = auth()->user();
        $browsing_histories = $user->browsing_histories;

        $extended_browsing_histories = $browsing_histories->map(function ($browsing_history) {
            $vehicle = $this->findVehicleByRegistrationNumber($browsing_history->searched_registration_number);
            return [
                'browsing_history' => $browsing_history,
                'vehicle' => $vehicle
            ];
        })->all();
    
        return view('browsing_histories.index', [
            'extended_browsing_histories' => $extended_browsing_histories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){}

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

        // try to find the vehicle by registration number
        $vehicle = $this->findVehicleByRegistrationNumber($validated['registration_number']);

        if (isset($vehicle)) {
            // create a new browsing history
            $browsing_history = BrowsingHistory::factory()->create([
                'searched_registration_number' => $validated['registration_number'],
                'searched_at' => now()->format('Y-m-d'),
            ]);
            // associate the browsing history with the current user
            $browsing_history->user()->associate(auth()->user())->save();

            return redirect()->route('vehicles.show', $vehicle);
        }else{
            Session::flash('non_existent_registration_number');
            return redirect('home');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){}

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
