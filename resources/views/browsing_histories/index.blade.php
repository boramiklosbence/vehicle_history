@extends('layouts.app')

@section('title', 'Előzmények')

@section('content')
    <div class="container">
        <h1>Előzmények</h1>
        <div class="mb-4">
            <a href="{{ route('home.index')}}"><i class="fa-solid fa-chevron-left"></i></i> Vissza a főoldalra</a>
        </div>
        {{-- Browsing histories --}}
        <div class="row justify-content-center mb-2">
            <div class="col-md-10 col-lg-8">
                @foreach ( $browsing_histories as $browsing_history )
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 text-center"></div>
                                <div class="col-4 text-center">{{$browsing_history->searched_registration_number}}</div>
                                <div class="col-4 text-center">{{$browsing_history->searched_at}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
