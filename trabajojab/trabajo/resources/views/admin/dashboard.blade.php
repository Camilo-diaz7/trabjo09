
@extends('layouts.dash')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adminitrador</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center">

                    </div>

                        @auth
                            <h4>Bienvenido, {{ auth()->user()->name }}!</h4>
                            @if(auth()->user()->is_admin ?? false)
                                <p class="text-muted">Has iniciado sesión como Administrador.</p>
                            @endif
                        @else
                            <h4>Bienvenido, Administrador!</h4>
                        @endauth
                    </div></div>
            </div>
        </div>
    </div>

@endsection
