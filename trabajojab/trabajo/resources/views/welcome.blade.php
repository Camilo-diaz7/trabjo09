<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bienvenido a Mi Sitio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Nunito', sans-serif;
            color: white;
        }

        /* 🔹 Imagen de fondo */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("{{ asset('images/SAR.png') }}") no-repeat center center fixed;
            background-size: cover;
            z-index: -1;
            filter: brightness(0.5);
        }

        .content {
            position: relative;
            height: 150vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        h1 {
            color: greenyellow;
            font-size: 3rem;
            font-weight: bold;
        }

        .btn-custom {
            margin: 10px;
            padding: 10px 25px;
            font-size: 1.1rem;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="background"></div>

    <div class="content">
        <h1>Bienvenido a Droguería sar</h1>
        <div >
            <a href="{{ route('login') }}" class="btn  btn-custom w-100">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn btn-custom w-100">Registrarse</a>
        </div>
    </div>

</body>
</html>
