@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center mt-5 mb-5">Neue Besucherkarte</h3>

    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ( $errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('visitors.index') }}" class="btn btn-outline-secondary btn-sm" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path
                        d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                </svg>
                Zurück
            </a>
        </div>
    </div>

    <div class="card shadow p-3">

        <form action="{{ route('visitors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class=" row">
                <div class="col-5 mb-4">
                    <label for="image" class="form-label">
                        Bild
                        <span class="text-danger">*</span>
                    </label>
                    <img src="" id="file-preview" alt="" class="rounded form-control mb-2" />
                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                        value="{{ old('image') }}" name="image" id="image" accept="image/*"
                        onchange="showFile(event)" />

                    <div class=" pt-2">
                        @error('image')
                        <div class=" alert alert-danger">{{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col mb-4">
                    <label for="first_name" class="form-label">
                        Vorname
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                        id="first_name" placeholder="Vorname" value="{{ old('first_name') }}" />

                    <div class="pt-2">
                        @error('first_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class=" row">
                <div class="col mb-4">
                    <label for="last_name" class="form-label">
                        Nachname
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                        id="last_name" placeholder="Nachname" value="{{ old('last_name') }}" />

                    <div class="pt-2">
                        @error('last_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class=" row">
                <div class="col mb-4">
                    <label for="tel_nr" class="form-label">
                        Beruf
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('profession') is-invalid @enderror" name="profession"
                        id="profession" placeholder="Drummer - Autor - Web Developer" value="{{ old('profession') }}" />

                    <div class="pt-2">
                        @error('profession')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class=" row">
                <div class="col mb-4">
                    <label for="tel_nr" class="form-label">
                        Telefonnr.
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('tel_nr') is-invalid @enderror" name="tel_nr"
                        id="tel_nr" placeholder="Telefonnummer" value="{{ old('tel_nr') }}" />

                    <div class="pt-2">
                        @error('tel_nr')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class=" row">
                <div class="col mb-4">
                    <label for="email" class="form-label">
                        eMail
                        <span class="text-danger">*</span>
                    </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" placeholder="eMail" value="{{ old('email') }}" />

                    <div class="pt-2">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class=" col-12">
                <button type="submit" class="btn btn-outline-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check2-all" viewBox="0 0 16 16">
                        <path
                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                    </svg>
                    Bestätigen
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function showFile(event){
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
                var dataURL = reader.result;
                var output = document.getElementById('file-preview');
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
        }
</script>

@endsection