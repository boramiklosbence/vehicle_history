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
                @forelse ( $browsing_histories as $browsing_history)
                    <div class="card mb-2 hover">
                        <div class="card-body d-flex align-items-center">
                            <div class="col-3">
                                @php
                                    $vehicle = $vehicles->where('registration_number', $browsing_history->searched_registration_number)->first();
                                @endphp
                                <img 
                                    src="{{ isset($vehicle->image_path) ? asset('storage/'.$vehicle->image_path) : asset('storage/default_vehicle.jpg') }}"
                                    class="mx-auto d-block rounded" 
                                    style="max-width: 25%;"
                                    alt="Jármű"
                                >
                            </div>
                            <div class="col-3 text-center">{{$browsing_history->searched_registration_number}}</div>
                            <div class="col-3 text-center">{{$browsing_history->searched_at}}</div>
                            <div class="col-3 text-center">
                                <a role="button" class="btn btn-primary search-btn" data-hidden-value="{{$browsing_history->searched_registration_number}}">
                                    Megtekintés
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-primary" role="alert">
                        Nincs megjeleníthető keresési előzmény.
                    </div>
                @endforelse
                <div class="d-flex justify-content-center">
                    {{$browsing_histories->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.search-btn', function(e) {
            e.preventDefault();
            const hiddenValue = $(this).data('hidden-value');

            // Create a form
            const form = $('<form action="{{ route("browsing_histories.store") }}" method="POST" enctype="multipart/form-data"></form>');
            form.append('@csrf');
            form.append('<input type="hidden" name="registration_number" value="' + hiddenValue + '">');

            // Append the form to the body and submit
            $('body').append(form);
            form.submit();
        });
    </script>
@endsection
