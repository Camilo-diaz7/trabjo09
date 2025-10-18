<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\tipo_productos;
use Illuminate\Http\Request;

class TipoProductosController extends Controller
{
    /**
     * Mostrar lista de tipos con sus productos relacionados.
     * Usamos eager loading para evitar consultas N+1 en la vista.
     */
    public function index()
    {
        $tipo = tipo_productos::with('productos')->get();
        return view('admin.tipo.index', compact('tipo'));
    }

    /**
     * Mostrar formulario para crear un nuevo tipo (opcional).
     */
    public function create()
    {
        return view('admin.tipo.create');
    }

    /**
     * Almacenar un nuevo tipo en la base de datos.
     */
    /**
     * Almacenar un nuevo tipo en la base de datos.
     * Valida nombre, descripcion y categoria (comestible/licor).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:100',
            'categoria' => 'nullable|in:comestible,licor',
        ]);

        tipo_productos::create($request->only(['nombre','descripcion','categoria']));
        return redirect()->route('admin.tipo.index')->with('success','Tipo de producto creado correctamente');
    }

    /**
     * Mostrar un tipo específico (no implementado en detalle).
     */
    public function show(tipo_productos $tipo_productos)
    {
        return view('admin.tipo.show', compact('tipo_productos'));
    }

    /**
     * Mostrar formulario de edición para un tipo específico.
     */
    public function edit(tipo_productos $tipo_productos)
    {
        return view('admin.tipo.edit', compact('tipo_productos'));
    }

    /**
     * Actualizar un tipo existente.
     */
    /**
     * Actualizar un tipo existente.
     * Valida nombre, descripcion y categoria.
     */
    public function update(Request $request, tipo_productos $tipo_productos)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:100',
            'categoria' => 'nullable|in:comestible,licor',
        ]);

        $tipo_productos->update($request->only(['nombre','descripcion','categoria']));
        return redirect()->route('admin.tipo_productos.index')->with('success','Tipo de producto actualizado correctamente');
    }

    /**
     * Eliminar un tipo de producto.
     */
    public function destroy(tipo_productos $tipo_productos)
    {
        // Nota: antes de eliminar, podrías comprobar si tiene productos relacionados
        // y decidir si impedir la eliminación o reasignarlos.
        $tipo_productos->delete();
        return redirect()->route('admin.tipo_productos.index')->with('success','Tipo de producto eliminado correctamente');
    }
}
