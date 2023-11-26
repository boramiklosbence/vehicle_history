@extends('layouts.app')

@section('title', 'Káresemény')

@section('content')
<div class="container">
    <h1>Káresemény adatai</h1>
    <div class="mb-4">
        <a href="{{ route('home.index') }}"><i class="fa-solid fa-chevron-left"></i></i> Vissza a főoldalra</a>
    </div>
    {{-- Loss event details --}}
    <div class="row justify-content-center mb-2">
        <div class="col-md-10 col-lg-8">
            <div class="card">
                <div class="card-header">Alap adatok</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <p><span class="fw-bold">Helyszín: </span>{{ $loss_event->location }}</p>
                            <p><span class="fw-bold">Dátum: </span> {{ $loss_event->date }}</p>
                            <p><span class="fw-bold">Leírás: </span> {{ $loss_event->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Vehicles --}}
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            @foreach ($loss_event->vehicles as $vehicle)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-4">
                                <img 
                                    src="{{ isset($vehicle->image_path) ? asset('storage/'.$vehicle->image_path) : asset('storage/default_vehicle.jpg') }}" 
                                    class="rounded mx-auto d-block mb-2 mb-lg-0 img-thumbnail" 
                                    alt="Jármű"
                                >
                            </div>
                            <div class="col-8">
                                <p><span class="fw-bold">Rendszám: </span>{{ $vehicle->registration_number }}</p>
                                <p><span class="fw-bold">Márka: </span> {{ $vehicle->brand }}</p>
                                <p><span class="fw-bold">Típus: </span> {{ $vehicle->type }}</p>
                                <p><span class="fw-bold">Gyártási év: </span> {{ $vehicle->year }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
