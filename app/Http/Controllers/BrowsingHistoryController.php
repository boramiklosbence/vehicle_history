<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Traits\CommonTrait;

use App\Models\Vehicle;
use App\Models\BrowsingHistory;

class BrowsingHistoryController extends Controller
{
    use CommonTrait;

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        
        $vehicles = Vehicle::all(); 
        $browsing_histories = BrowsingHistory::where('user_id', auth()->user()->id)->paginate(10);

        return view('browsing_histories.index', [
            'vehicles' => $vehicles,
            'browsing_histories' => $browsing_histories,
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
        if (!Auth::check()) {
            return redirect('login');
        }

        $validated = $request->validate([
            'registration_number' => [
                'required',
                'regex:/^(?:[A-Za-z]{3}-?\d{3}|[A-Za-z]{3}\d{3})$/',
            ]
        ], [
            'registration_number.required' => 'A mező kitöltése kötelező.',
            'registration_number.regex' => 'A megadott rendszám formátuma nem megfelelő.'
        ]);        

        $formatted_registration_number = $this->transformRegistrationNumber($validated['registration_number']);

        $vehicle =  Vehicle::where('registration_number', $formatted_registration_number)->first();

        if ($vehicle) {
            $browsing_history = BrowsingHistory::factory()->create([
                'searched_registration_number' => $formatted_registration_number,
                'searched_at' => now()->format('Y-m-d'),
            ]);

            $browsing_history->user()->associate(auth()->user())->save();

            return redirect()->route('vehicles.show', $vehicle);
        } else {
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
