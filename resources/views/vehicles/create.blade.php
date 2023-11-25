@extends('layouts.app')
@section('title', 'Jármű rögzítés')

@section('content')
    <div class="container">
        <h1>Jármű rögzítés</h1>
        <div class="mb-4">
            <a href="{{ route('home.index') }}">
                <i class="fa-solid fa-chevron-left"></i> Vissza a főoldalra
            </a>
        </div>
        @if (Session::has('vehicle_created'))
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 ">
                    <div class="alert alert-success" role="alert">
                        A(z) {{session('registration_number')}} rendszámmal rendelkező jármű rögzítve lett az adatbázisban.<br />
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form method="post" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- Registration number input --}}
                    <div class="form-group row mb-3">
                        <label for="registration_number" class="col-sm-2 col-form-label">Rendszám:</label>
                        <div class="col-sm-10">
                            <input 
                                  type="text" 
                                  id="registration_number" 
                                  name="registration_number"
                                  class="form-control @error('registration_number') is-invalid @else @if (old('registration_number')) is-valid @endif @enderror"
                                  placeholder="XYZ-123"
                                  value="{{ old('registration_number') }}"
                            >
                            @error('registration_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Brand input --}}
                    <div class="form-group row mb-3">
                        <label for="brand" class="col-sm-2 col-form-label">Márka:</label>
                        <div class="col-sm-10">
                            <input 
                                  type="text" 
                                  id="brand" 
                                  name="brand"
                                  class="form-control @error('brand') is-invalid @else @if (old('brand')) is-valid @endif @enderror"
                                  placeholder="Mercedes-Benz"
                                  value="{{ old('brand') }}"
                            >
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Type input --}}
                    <div class="form-group row mb-3">
                        <label for="type" class="col-sm-2 col-form-label">Típus:</label>
                        <div class="col-sm-10">
                            <input 
                                  type="text" 
                                  id="type" 
                                  name="type"
                                  class="form-control @error('type') is-invalid @else @if (old('type')) is-valid @endif @enderror"
                                  placeholder="W140"
                                  value="{{ old('type') }}"
                            >
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Year input --}}
                    <div class="form-group row mb-3">
                        <label for="year" class="col-sm-2 col-form-label">Gyártási év:</label>
                        <div class="col-sm-10">
                            <input 
                                  type="number" 
                                  name="year" 
                                  id="year"
                                  class="form-control @error('year') is-invalid @else @if (old('year')) is-valid @endif @enderror"
                                  placeholder="1991"
                                  value="{{ old('year') }}"
                            >
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Image input --}}
                    <div class="form-group row mb-3">
                        <label for="img" class="col-sm-2 col-form-label">Kép:</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input 
                                              type="file" 
                                              id="img" 
                                              name="img"
                                              class="form-control-file @error('img') is-invalid @enderror"
                                        >
                                        @error('img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div id="preview" class="col-12 d-none">
                                        <p>Kép előnezet:</p>
                                        <img 
                                            src="#" 
                                            id="preview_image" 
                                            alt="Jármű" 
                                            width="300px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Submit button --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mentés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const coverImageInput = document.querySelector('input#img');
        const coverPreviewContainer = document.querySelector('#preview');
        const coverPreviewImage = document.querySelector('img#preview_image');

        coverImageInput.onchange = event => {
            const [file] = coverImageInput.files;
            if (file) {
                coverPreviewContainer.classList.remove('d-none');
                coverPreviewImage.src = URL.createObjectURL(file);
            } else {
                coverPreviewContainer.classList.add('d-none');
            }
        }
    </script>
@endsection
