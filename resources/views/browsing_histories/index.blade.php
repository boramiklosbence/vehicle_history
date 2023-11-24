@extends('layouts.app')

@section('title', 'Előzmények')

@section('content')
    <div class="container">
        <h1>Előzmények</h1>
        <div class="mb-4">
            <a href="{{ route('home.index') }}">
                <i class="fa-solid fa-chevron-left"></i> Vissza a főoldalra
            </a>
        </div>

        {{-- Browsing histories --}}
        <div class="row justify-content-center mb-2">
            <div class="col-md-10 col-lg-8">
                @foreach($extended_browsing_histories as $extended_browsing_history)
                    <div class="card mb-2 hover">
                        <div class="card-body d-flex align-items-center">
                            <div class="col-3">
                                <img 
                                    src="{{ $extended_browsing_history['vehicle']['image_path'] ? './storage/'.$extended_browsing_history['vehicle']['image_path'] : asset('storage/images/default_vehicle.jpg') }}" 
                                    class="mx-auto d-block rounded" 
                                    style="max-width: 25%;"
                                    alt="Jármű"
                                >
                            </div>
                            <div class="col-3 text-center">{{$extended_browsing_history['browsing_history']['searched_registration_number']}}</div>
                            <div class="col-3 text-center">{{$extended_browsing_history['browsing_history']['searched_at']}}</div>
                            <div class="col-3 text-center">
                                <a href="#" role="button" class="btn btn-primary">
                                    Megtekintés
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
