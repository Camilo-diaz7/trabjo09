@extends('layouts.dash')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-4">Tipos de Productos</h1>

    {{-- Formulario para crear nuevo tipo --}}
    <div class="card mb-4">
        <div class="card-header">Crear nuevo tipo</div>
        <div class="card-body">
            <form action="{{ route('admin.tipo_productos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                    @error('nombre')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control">
                    @error('descripcion')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tipo_producto_id" class="form-label">Categoría</label>
                    <select id="tipo_producto_id" name="tipo_producto_id" class="form-select">
                        <option value="">-- Seleccionar --</option>
                        <option value={{ old('tipo_productso_id') == 'curas' ? 'selected' : '' }}>curas</option>
                        <option value={{ old('tipo_producto_id') == 'medicamentos' ? 'selected' : '' }}>Medicamentos</option>
                    </select>
                    @error('tipo_producto_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Crear tipo</button>
            </form>
        </div>
    </div>

    @foreach($tipo as $t)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>{{ $t->nombre }}</strong>
                <span class="text-muted">ID: {{ $t->id }}</span>
                <span class="badge bg-info">{{ $t->categoria ?? 'Sin categoría' }}</span>
            </div>
            <div class="card-body">
                @if($t->productos && $t->productos->count())
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Categoría producto</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($t->productos as $producto)
                                <tr>
                                               <td>
                                {{ $producto->tipoProductos?->nombre ?? '—' }}
                                @if($producto->tipoProductos?->descripcion)
                                    <small class="d-block text-muted">{{ $producto->tipoProductos->descripcion }}</small>
                                @endif
                            </td>
                            <td>{{ $producto->stock ?? '—' }}</td>
                                        {{-- Formulario para reasignar producto a otro tipo --}}
                                        <form action="{{ route('admin.productos.update', $producto) }}" method="POST" class="d-inline-flex align-items-center">
                                            @csrf
                                            @method('PUT')
                                            <select name="tipo_productos_id" class="form-select form-select-sm me-2" style="width:auto">
                                                <option value="">-- Sin tipo --</option>
                                                @foreach(App\Models\tipo_productos::all() as $opt)
                                                    <option value="{{ $opt->id }}" {{ $producto->tipo_productos_id == $opt->id ? 'selected' : '' }}>{{ $opt->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-sm btn-primary">Mover</button>
                                        </form>
                                    </td>
                                    <td>
                                       <div class="d-flex align-items-center">
+                    <form action="{{ route('admin.tipo_productos.destroy', $t) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Eliminar este tipo? Esta acción no se puede deshacer.');">
+                        @csrf
+                        @method('DELETE')
+                        <button class="btn btn-sm btn-outline-danger">Eliminar</button>
+                    </form>
+                </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-muted">No hay productos asignados a este tipo.</div>
                @endif
            </div>
        </div>
    @endforeach

{{-- Documentación:
    - Esta vista permite crear tipos de producto, ver su categoría y los productos asociados.
    - El campo 'categoria' distingue entre comestible y licor.
    - Los métodos del controlador están documentados y validados.
--}}

</div>
@endsection
