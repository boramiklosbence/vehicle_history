@extends('layouts.app')

@section('title', 'Keresési eredmény')

@section('content')
    <div class="container">

        <div class="row justify-content-between">
            <div class="col-12 col-md-8">
                <h1>Keresési eredmény</h1>
                <div class="mb-4">
                    <a href="{{ route('home.index')}}"><i class="fa-solid fa-chevron-left"></i> Vissza a főoldalra</a>
                </div>
            </div>
        </div>


        @if (Session::has('not_premium_user'))
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 ">
                    <div class="alert alert-danger" role="alert">
                        Nincs jogosultságod a káresemény részletes megtekintéséhez.<br>
                    </div>
                </div>
            </div>
        @endif
        {{-- Vehicle details --}}
        <div class="row justify-content-center mb-2">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Jármű adatai
                        <div class="float-end">
                            <a href="{{route("vehicles.edit", $vehicle)}}" role="button" class="btn btn-sm btn-primary mb-1">
                                <i class="fa-solid fa-pen"></i> Szerkesztés
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-2">
                                <img 
                                    src="{{ isset($vehicle->image_path) ? asset('storage/'.$vehicle->image_path) : asset('storage/default_vehicle.jpg') }}" 
                                    class="rounded mx-auto d-block img-fluid" 
                                    alt="Jármű"
                                >
                            </div>
                            <div class="col-12 col-sm-4 col-md-6 col-lg-8">
                                <p><span class="fw-bold">Rendszám: </span>{{ $vehicle->registration_number }}</p>
                                <p><span class="fw-bold">Márka: </span> {{ $vehicle->brand }}</p>
                                <p><span class="fw-bold">Típus: </span> {{ $vehicle->type }}</p>
                                <p><span class="fw-bold">Gyártási év: </span> {{ $vehicle->year }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Loss events --}}
        <div class="row justify-content-center mb-2">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">Káresemények</div>
                    <div class="card-body">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Helyszín</th>
                                    <th scope="col">Dátum</th>
                                    <th scope="col">Leírás</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loss_events as $loss_event)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}.</td>
                                        <td>{{ $loss_event->location }}</td>
                                        <td>{{ $loss_event->date }}</td>
                                        <td>{{ $loss_event->description }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('loss_events.show', $loss_event) }}" role="button" class="btn btn-primary">
                                                Részletek
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
