<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Vehicle;

class LossEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loss_events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loss_events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('loss_events.store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('loss_events.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('loss_events.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return view('loss_events.update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return view('loss_events.destroy');
    }
}
