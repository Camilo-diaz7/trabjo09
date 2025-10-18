{{-- resources/views/admin/productos/index.blade.php --}}
@extends('layouts.dash')

@section('title', 'Productos')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Productos</h1>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Crear producto</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($productos->isEmpty())
        <div class="card">
            <div class="card-body">
                <p class="mb-0">No hay productos aún.</p>
            </div>
        </div>
    @else
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>
                                @if(!empty($producto->imagen_url))
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $producto->imagen_url }}" alt="" style="width:42px;height:42px;object-fit:cover;border-radius:4px;margin-right:8px;">
                                        <div>
                                            <strong>{{ $producto->nombre }}</strong>
                                            @if($producto->slug)
                                                <div class="text-muted small">{{ $producto->slug }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <strong>{{ $producto->nombre }}</strong>
                                @endif
                            </td>
                            <td>{{ $producto->categoria?->nombre ?? '—' }}</td>
                            <td>{{ isset($producto->precio) ? number_format($producto->precio, 2) . ' €' : '—' }}</td>
                            <td>{{ $producto->stock ?? '—' }}</td>
                            <td>
                                @if($producto->activo ?? false)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.productos.show', $producto) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                                <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                                <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Eliminar este producto? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">Mostrando {{ $productos->firstItem() ?? 0 }} - {{ $productos->lastItem() ?? 0 }} de {{ $productos->total() ?? $productos->count() }} productos</small>
                <div>
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
