
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }}</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            background: #000000;
            width: 250px;
        }

        .sidebar-item {
            padding: .5rem 1rem;
            color: #fff;
            text-decoration: none;
            display: block;
            transition: 0.3s;
        }

        .sidebar-item:hover {
            background: #495057;
            color: #fff;
        }

        .sidebar-item i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }

        .navbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 250px;
            z-index: 99;
            background: #fff !important;
            box-shadow: 0 2px 4px rgba(56, 160, 8, 0.87);
        }

        .card-dash {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(187, 21, 21, 0.856);
            transition: transform 0.3s;
        }

        .card-dash:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="text-center mb-4">
            <img src="{{ asset('images/SAR.png') }}" alt="Logo" width="120">
        </div>

        <a href="{{ route('admin.dashboard') }}" class="sidebar-item">
            <i class="fas fa-home"></i> Dashboard
        </a>

        <a href='{{ route('admin.productos.index') }}' class="sidebar-item">
            <i class="fas fa-box"></i> Productos
        </a>

        <a href="{{ route('admin.tipo_productos.index') }}" class="sidebar-item">
            <i class="fas fa-tags"></i> Tipos de Productos
        </a>

        <a href="{{ route('logout') }}" class="sidebar-item"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>

    <!-- Navbar superior -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <h4 class="mb-0">{{ $title ?? 'Dashboard' }}</h4>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="main-content">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
