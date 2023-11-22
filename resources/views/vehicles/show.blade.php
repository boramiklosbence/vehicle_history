@extends('layouts.app')

@section('title', 'Keresési eredmény')

@section('content')
    <div class="container">
        <h1>Keresési eredmény</h1>
        <div class="mb-4">
            <a href="{{ route('home.index')}}"><i class="fa-solid fa-chevron-left"></i></i> Vissza a főoldalra</a>
        </div>
        {{-- Vehicle details --}}
        <div class="row justify-content-center mb-2">
            <div class="col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">Jármű adatai</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 mb-2">
                                <img src="{{ isset($vehicle->image_path) ? './storage/' . $vehicle->image_path : asset('storage/images/default_vehicle.jpg') }}" class="rounded mx-auto d-block img-thumbnail" alt="Jármű">
                            </div>
                            <div class="col-lg-8">
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
            <div class="col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">Káresemények</div>
                    <div clasd="card-body">
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
                                            <a href="{{ route('loss_events.show', $loss_event) }}" role="button" class="btn btn-secondary">
                                                Megtekintés
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
