@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mt-5">
                <div class="card-header text-center">
                    {{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Sie sind eingeloggt') }}


                    @if (Auth::check() && Auth::user()->is_admin)

                    {{ __('und haben nun erweiterte Rechte!') }}

                    <div class="panel-body">

                        <a href="{{ route('visitors.index') }}" class="btn btn-outline-primary btn-sm mt-3">Weiter</a>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

    @endsection