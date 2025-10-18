{{--
    resources/views/admin/productos/show.blade.php
    Vista "show" para un Producto (Admin)

    Uso:
    - Espera una variable $producto (Model) pasada desde el controlador.
    - Rutas asumidas (ajusta si tu proyecto usa nombres distintos):
        - admin.productos.index  -> lista de productos
        - admin.productos.edit   -> editar producto
        - admin.productos.destroy-> eliminar producto (DELETE)
    - Si la imagen se guarda en storage/app/public, se usa asset('storage/...') para mostrarla.
--}}

@extends('layouts.dash')

@section('title', 'Detalle del producto')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Detalle del producto</h1>
        <div>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary btn-sm">Volver</a>
            <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-primary btn-sm">Editar</a>
            <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este producto? Esta acción no se puede deshacer.');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                {{-- Imagen principal: ajustar campo según tu modelo (image, foto, imagen_url, etc.) --}}
                @if(!empty($producto->image))
                    <img src="{{ asset('storage/' . $producto->image) }}" class="img-fluid rounded-start" alt="{{ $producto->name }}">
                @elseif(!empty($producto->imagen))
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid rounded-start" alt="{{ $producto->name }}">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height:100%;">
                        <span class="text-muted">Sin imagen</span>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title mb-1">{{ $producto->name ?? $producto->titulo ?? 'Nombre no disponible' }}</h2>
                    @if(!empty($producto->sku))
                        <p class="text-muted mb-2">SKU: {{ $producto->sku }}</p>
                    @endif

                    <div class="mb-3">
                        <h4 class="mb-0">
                            @if(isset($producto->price))
                                ${{ number_format($producto->price, 2, ',', '.') }}
                            @elseif(isset($producto->precio))
                                ${{ number_format($producto->precio, 2, ',', '.') }}
                            @else
                                <span class="text-muted">Precio no disponible</span>
                            @endif
                        </h4>
                        @if(isset($producto->stock))
                            <small class="text-muted">Stock: {{ $producto->stock }}</small>
                        @endif
                    </div>

                    <hr>

                    <h5 class="h6">Descripción</h5>
                    <p class="card-text">
                        {!! nl2br(e($producto->description ?? $producto->descripcion ?? 'Sin descripción')) !!}
                    </p>

                    @if(!empty($producto->categoria) || !empty($producto->categories))
                        <p>
                            <strong>Categoría:</strong>
                            @if(!empty($producto->categoria))
                                {{ $producto->categoria }}
                            @else
                                {{ $producto->categories->pluck('name')->join(', ') }}
                            @endif
                        </p>
                    @endif

                    <div class="mt-3 text-muted small">
                        @if(isset($producto->created_at))
                            Creado: {{ $producto->created_at->format('d/m/Y H:i') }}
                        @endif
                        @if(isset($producto->updated_at))
                            &nbsp; | &nbsp; Última edición: {{ $producto->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
