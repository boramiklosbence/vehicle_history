<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use \App\Models\User;
use \App\Models\Vehicle;
use \App\Models\LossEvent;
use \App\Policies\LossEventPolicy;


class LossEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){}

    /**
     * Show the form for creating a new resource.
     */
    public function create(){}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){}

    /**
     * Display the specified resource.
     */
    public function show(LossEvent $loss_event)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (auth()->user()->cannot('view', $loss_event)) {
            Session::flash('not_premium_user');
            return redirect()->back();
        }

        return view('loss_events.show', [
            'loss_event' => $loss_event
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
