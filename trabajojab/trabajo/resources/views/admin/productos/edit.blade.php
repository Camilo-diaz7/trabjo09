@extends('layouts.dash')

@section('content')
<div class="container">
    <h1>Editar producto</h1>

    @if ($errors->any())
       <div class="alert alert-danger">
          <strong>Hay errores en el formulario:</strong>
          <ul>
             @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
             @endforeach
          </ul>
       </div>
    @endif

    <form action="{{ route('admin.productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
       @csrf
       @method('PUT')

       <div class="mb-3">
          <label for="nombre" class="form-label">Nombre *</label>
          <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
       </div>


       {{-- Categoria (comestible o licor) --}}
       <div class="mb-3">
          <label for="tipo_producto_id" class="form-label">Categoría</label>
          <select id="tipo_producto_id" name="categoria" class="form-select">
             <option value="">-- Seleccionar --</option>
             <option value="curas" {{ old('tipo_producto_id', $producto->categoria) == 'curas' ? 'selected' : '' }}>Cura</option>
             <option value="medicamentos" {{ old('tipo_producto_id', $producto->categoria) == 'medicamentos' ? 'selected' : '' }}>Medicamentos</option>
          </select>
       </div>  

       <div class="mb-3">
          <label for="precio" class="form-label">Precio *</label>
          <input type="number" id="precio" name="precio" step="0.01" min="0" class="form-control" value="{{ old('precio', $producto->precio) ?? '0.00' }}" required>
       </div>

       <div class="mb-3">
          <label for="stock" class="form-label">Stock</label>
          <input type="number" id="stock" name="stock" min="0" class="form-control" value="{{ old('stock', $producto->stock) ?? 0 }}">
       </div>

       <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" {{ old('activo', $producto->activo) ? 'checked' : '' }}>
          <label class="form-check-label" for="activo">Activo</label>
       </div>

       <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Actualizar producto</button>
          <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
       </div>
    </form>
 </div>
@endsection
