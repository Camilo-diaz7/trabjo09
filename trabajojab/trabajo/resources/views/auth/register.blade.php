@extends('layouts.appu')

@section('content')
<div class="card-header">{{ __('Registrarse') }}</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="name">{{ __('Nombre') }}</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div class="mb-3">
        <label for="email">{{ __('Correo Electrónico') }}</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label for="password">{{ __('Contraseña') }}</label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>

    <div class="mb-3">
        <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-primary">{{ __('Registrarse') }}</button>

    <a class="btn-link" href="{{ route('login') }}">{{ __('¿Ya tienes una cuenta? Inicia sesión') }}</a>
</form>
@endsection
