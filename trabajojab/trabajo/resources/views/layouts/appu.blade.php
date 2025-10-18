<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Drogerías SAR') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Fondo general */
        body {
            background: url("{{ asset('images/SAR.png') }}") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Contenedor central */
        .auth-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        /* Tarjeta translúcida */
        .card {
            background: rgba(0, 0, 0, 0.75);
            color: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            padding: 30px;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #9eff8a;
            margin-bottom: 15px;
        }

        label {
            color: #d1ffd1;
        }

        /* Inputs personalizados */
        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
            border-radius: 10px;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: #a9ff82;
            box-shadow: 0 0 8px rgba(168, 255, 168, 0.6);
            color: #ffffff;
        }

        /* Botones */
        .btn-primary {
            background-color: #28a745;
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 1.1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: white;
            color: #28a745;
            transform: scale(1.05);
        }

        /* Enlaces */
        a.btn-link {
            color: #9eff8a;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        a.btn-link:hover {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="card">
            @yield('content')
        </div>
    </div>
</body>
</html>
