
@extends('layouts.dash')

@section('content')
<div class="container">
    {{-- Título --}}
    <h1>Crear producto</h1>
    <p class="text-muted">Formulario para agregar un nuevo producto. Los campos marcados con * son obligatorios.</p>

    {{-- Mostrar mensajes de validación generales (si existen) --}}
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

    {{-- Formulario principal
        - action: ruta nombrada para almacenar el producto (ajusta según tus rutas)
        - enctype necesario para subir imágenes --}}
    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
       @csrf

       {{-- Nombre --}}
       <div class="mb-3">
          <label for="nombre" class="form-label">Nombre *</label>
          <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
          @error('nombre')
             <div class="text-danger small">{{ $message }}</div>
          @enderror
          <div class="form-text">El nombre del producto. A partir de aquí se puede generar el slug automáticamente.</div>
       </div>

       {{-- Slug (URL amigable) --}}
       <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}">
          @error('slug')
             <div class="text-danger small">{{ $message }}</div>
          @enderror
          <div class="form-text">Cadena amigable para la URL. Se auto llena desde el nombre, pero puedes editarla.</div>
       </div>



       {{-- Categoria (comestible o licor) --}}
       <div class="mb-3">
          <label for="categoria" class="form-label">Categoría</label>
          <select id="categoria" name="categoria" class="form-select">
             <option value="">-- Seleccionar --</option>
             <option value="comestible" {{ old('categoria') == 'comestible' ? 'selected' : '' }}>Comestible</option>
             <option value="licor" {{ old('categoria') == 'licor' ? 'selected' : '' }}>Licor</option>
          </select>
          @error('categoria')
             <div class="text-danger small">{{ $message }}</div>
          @enderror
       </div>



       {{-- Descripción --}}
       <div class="mb-3">
          <label for="description" class="form-label">Descripción</label>
          <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
          @error('description')
             <div class="text-danger small">{{ $message }}</div>
          @enderror
       </div>

       {{-- Precio --}}
       <div class="mb-3">
          <label for="precio" class="form-label">Precio *</label>
          <input type="number" id="precio" name="precio" step="0.01" min="0" class="form-control" value="{{ old('precio') ?? '0.00' }}" required>
          @error('precio')
             <div class="text-danger small">{{ $message }}</div>
          @enderror
       </div>

       {{-- Stock --}}
       <div class="mb-3">
          <label for="stock" class="form-label">Stock</label>
          <input type="number" id="stock" name="stock" min="0" class="form-control" value="{{ old('stock') ?? 0 }}">
          @error('stock')
             <div class="text-danger small">{{ $message }}</div>
          @enderror
       </div>
       {{-- Activo --}}
       <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" {{ old('activo', true) ? 'checked' : '' }}>
          <label class="form-check-label" for="activo">Activo</label>
       </div>

       {{-- Botones --}}
       <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Guardar producto</button>
          <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
       </div>
    </form>
</div>

{{-- Scripts específicos para esta vista:
    - Generar slug a partir del nombre automáticamente
    - Mostrar vista previa de imagen seleccionada --}}
@push('scripts')
<script>
    // Genera un slug simple: minúsculas, espacios -> guiones, elimina caracteres inválidos.
    function generateSlug(text) {
       return text.toString().toLowerCase()
          .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // quita acentos
          .replace(/[^a-z0-9\s-]/g, '') // quita caracteres no válidos
          .trim()
          .replace(/\s+/g, '-') // espacios a guiones
          .replace(/-+/g, '-'); // guiones múltiples a uno
    }

    document.addEventListener('DOMContentLoaded', function () {
       var nameInput = document.getElementById('name');
       var slugInput = document.getElementById('slug');

       // Si el usuario cambia el nombre y el slug está vacío o coincide con la versión generada anterior, actualizar slug.
       var lastGenerated = '';
       nameInput && nameInput.addEventListener('input', function () {
          var generated = generateSlug(this.value);
          if (!slugInput.value || slugInput.value === lastGenerated) {
             slugInput.value = generated;
          }
          lastGenerated = generated;
       });


    });
</script>
@endpush
 
@endsection
