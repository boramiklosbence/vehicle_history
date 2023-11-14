@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('browsing_histories.store')}}">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-lg-10 mb-2 mb-sm-2 mb-lg-0">
                                    <input type="text" class="form-control" placeholder="XYZ-123">
                                </div>
                                <div class="col-lg-2 mb-2 mb-sm-2 mb-lg-0">
                                    <button type="submit" class="btn btn-primary w-100">Keresés</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{route('browsing_histories.index')}}" role="button" class="btn btn-secondary">Előzmények</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Üdvözöljük a Kártörténet weboldalán!</div>
                    <div class="card-body">
                        <p>Az autók világában bekövetkezett káreseményekkel való hatékony és gyorsan elérhető kezelés
                            érdekében
                            hoztuk létre Kártörténetet. Legyen Ön is részese az egyszerű és
                            átlátható kárkezelésnek!</p>

                        <p class="fw-bold">Főbb szolgáltatásaink:</p>

                        <p>🚗 <span class="fw-bold">Kártörténet Keresése:</span> Használja keresőrendszerünket a gépjármű
                            kártörténeteinek gyors és hatékony
                            feltérképezéséhez. Böngéssze át az autók múltbeli káreseményeit, mielőtt döntést hozna!</p>

                        <p>📄 <span class="fw-bold">Részletes Információk:</span> Találjon részletes adatokat minden egyes
                            káreseményről, beleértve a
                            helyszínt, a dátumot és a káresemény résztvevőit. Így mindig teljes körű képet kaphat a
                            gépjármű történetéről.</p>

                        <p>🔍 <span class="fw-bold">Kiterjedt Adatbázis:</span> Rendszerünk folyamatosan frissülő
                            adatbázissal rendelkezik, amelyben széles
                            körű gépjárműk kártörténeti információi találhatók meg.</p>

                        <p>Az autóvásárlás, -eladás vagy -biztosítás előtt nézze meg a gépjármű kártörténetét, és hozzon
                            tájékozott döntéseket a mi segítségünkkel! Köszönjük, hogy velünk tart, és kívánunk sikeres
                            keresést!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
