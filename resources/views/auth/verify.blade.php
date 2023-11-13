@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Erősítse meg az email-címét') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Egy megerősítő linket küldtünk az email-címére.') }}
                        </div>
                    @endif

                    {{ __('Mielőtt folytatná, kérjük, ellenőrizze az email fiókját.') }}
                    {{ __('Ha nem kapta meg az e-mailt') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Kattintson ide, hogy újra kérjen egyet') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
