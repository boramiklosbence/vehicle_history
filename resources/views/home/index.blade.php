@extends('layouts.app')

@section('title', 'Főoldal')

@section('content')
    <div class="container">
        {{-- website description --}}
        <div class="row justify-content-center mb-2">
            <div class="col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">Üdvözöljük a Kártörténet weboldalán!</div>
                    <div class="card-body">
                        <p>
                            Az autók világában bekövetkezett káreseményekkel való hatékony és gyorsan elérhető kezelés
                            érdekében hoztuk létre Kártörténetet. Legyen Ön is részese az egyszerű és
                            átlátható kárkezelésnek!
                        </p>
                        <p class="fw-bold">Főbb szolgáltatásaink:</p>
                        <p>
                            🚗 <span class="fw-bold">Kártörténet Keresése:</span> Használja keresőrendszerünket a gépjármű
                            kártörténeteinek gyors és hatékony feltérképezéséhez. 
                            Böngéssze át az autók múltbeli káreseményeit, mielőtt döntést hozna!
                        </p>
                        <p>
                            📄 <span class="fw-bold">Részletes Információk:</span> Találjon részletes adatokat minden egyes
                            káreseményről, beleértve a helyszínt, a dátumot és a káresemény résztvevőit.
                            Így mindig teljes körű képet kaphat a gépjármű történetéről.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Search --}}
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('browsing_histories.store') }}">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-lg-10 mb-2 mb-lg-0">
                                    <input 
                                        type="text" 
                                        name="registration_number"
                                        class="form-control @error('registration_number') is-invalid @elseif (old('registration_number')) is-valid @endif"
                                        placeholder="XYZ-123" 
                                        value="{{ old('registration_number') }}"
                                    >
                                    @error('registration_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-magnifying-glass"></i> Keresés</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="{{ route('browsing_histories.index')}}" role="button" class="btn btn-light">
                                    Előzmények megtekintése
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Session::has('non_existent_registration_number'))
                    <div class="alert alert-danger mt-2" role="alert">
                        Az adatbázisban nem található olyan jármű, amely a megadott rendszámmal rendelkezik.<br />
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
