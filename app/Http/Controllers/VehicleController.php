<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Validation\Rule;

use App\Http\Traits\CommonTrait;

use \App\Models\Vehicle;
use \App\Policies\VehiclePolicy;

class VehicleController extends Controller
{
    use CommonTrait;

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

        if(auth()->user()->cannot('create', Vehicle::class)){
            Session::flash('not_admin_user');
            return redirect()->back();
        }

        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        if (!Auth::check()) {
            return redirect('login');
        }

        if(auth()->user()->cannot('create', Vehicle::class)){
            Session::flash('not_admin_user');
            return redirect()->back();
        }

        $request->validate([
            'registration_number' => [
                'required',
                'regex:/^(?:[A-Za-z]{3}-?\d{3}|[A-Za-z]{3}\d{3})$/',
                Rule::unique('vehicles', 'registration_number'),
            ],
            'brand' => 'required',
            'type' => 'required',
            'year' => [
                'required',
                'numeric',
                'integer',
                'gt:0',
                'lt:' . (date('Y')),
            ],
            'img' => 'required|file|mimes:jpg,png|max:4096',
        ],[
            'required' => 'A mező kitöltése kötelező.',
            'registration_number.regex' => 'A megadott rendszám formátuma nem megfelelő.',
            'registration_number.unique' => 'A megadott rendszám már létezik az adatbázisban.',
            'year.numeric' => 'A megadott év nem szám.',
            'year.integer' => 'A megadott év nem egész szám.',
            'year.gt' => 'A megadott év nem lehet kisebb mint 0.',
            'year.lt' => 'A megadott év nem lehet nagyobb mint ' . (date('Y')) . '.',
            'img.required' => 'Kép feltöltése kötelező.',
            'img.mimes' => 'A megadott fájl nem kép.',
            'img.max' => 'A megadott fájl mérete nem lehet nagyobb mint 4MB.',
        ]);

        $filename = '';
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = 'img' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put(
                $filename, $file->get()
            );
        }

        $formatted_registration_number = $this->transformRegistrationNumber($request->registration_number);

        $vehicle = Vehicle::factory()->create([
            'registration_number' => $formatted_registration_number,
            'brand' => $validated['brand'],
            'type' => $validated['type'],
            'year' => $validated['year'],
            'image_path' => $filename,
        ]);

        Session::flash('vehicle_created');
        return redirect()->route('vehicles.show', $vehicle);
    }

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
