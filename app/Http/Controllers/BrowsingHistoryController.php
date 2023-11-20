<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrowsingHistoryController extends Controller
{
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
        if (!Auth::check()) {
            return redirect('login');
        }

        $validated = $request->validate([
            'registration_number' => [
                'required',
                'regex:/^(?:[A-Za-z]{3}-?\d{3}|[A-Za-z]{3}\d{3})$/',
            ]
        ], [
            'registration_number.required' => 'A',
            'registration_number.regex' => 'B'
        ]);        

        return view('browsing_histories.index');
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
