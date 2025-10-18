@extends('layouts.appu')

@section('content')
<div class="card-header">{{ __('Iniciar Sesión') }}</div>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email">{{ __('Correo Electrónico') }}</label>
        <input id="email" type="email"
               class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password">{{ __('Contraseña') }}</label>
        <input id="password" type="password"
               class="form-control @error('password') is-invalid @enderror"
               name="password" required>
        @error('password')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">{{ __('Recordarme') }}</label>
    </div>

    <button type="submit" class="btn btn-primary">{{ __('Entrar') }}</button>

    @if (Route::has('password.request'))
        <a class="btn-link" href="{{ route('password.request') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
    @endif

    <a class="btn-link" href="{{ route('register') }}">{{ __('¿No tienes cuenta? Regístrate') }}</a>
</form>
@endsection
