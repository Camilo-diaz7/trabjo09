<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\tipo_productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Devuelve una lista paginada de productos.
        // Se ordena por id descendente para mostrar primero los más recientes.
        // La vista 'admin.productos.index' espera una variable $productos que soporte ->links()
        $productos = productos::orderBy('id','desc')->paginate(15);
        return view('admin.productos.index', compact('productos'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Prepara datos necesarios para el formulario de creación.
        // Pasamos $tipos para poder listar tipos en la vista si fuese necesario (aunque ahora la asignación de tipo
        // se realiza desde la vista de Tipos). Mantener esto facilita futuras mejoras.
        $tipos = tipo_productos::pluck('nombre','id');
        return view('admin.productos.create', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de entrada: tipo_productos_id es opcional (nullable). La categoría, si se envía, debe ser
        // 'comestible' o 'licor'.
        $request->validate([
            'nombre'=>'required|string|max:50',
            'precio'=>'required|numeric',
            'tipo_productos_id'=>'nullable|exists:tipo_productos,id',
            'categoria'=>'nullable|in:Cura,Medicamentos',
        ]);

        // Crear producto con los datos validados. $fillable en el modelo controla qué campos son masivos.
        productos::create($request->all());
        return redirect()->route('admin.productos.index')->with('success','Producto creado correctamente.');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(productos $producto)
    {
        // Mostrar detalle de un producto. Cargamos la relación tipoProductos si existe para mostrar info relacionada.
        $producto->load('tipoProductos');
        return view('admin.productos.show', compact('producto'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(productos $producto)
    {
        // Mostrar formulario de edición.
        // Nota: la interfaz de edición no incluye selección de tipo (se gestiona desde Admin->Tipos), pero
        // pasamos $tipos por si se quiere mostrar información adicional o habilitar edición directa.
        $tipos = tipo_productos::all();
        return view('admin.productos.edit', compact('producto','tipos'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, productos $producto)
    {
        // Validación similar a store; tipo_productos_id sigue siendo optional para permitir reasignaciones desde la
        // vista de Tipos (o actualizar desde edición si se quiere).
        $request->validate([
            'nombre'=>'required|string|max:50',
            'precio'=>'required|numeric',
            'tipo_productos_id'=>'nullable|exists:tipo_productos,id',
        ]);
        $producto->update($request->all());
        return redirect()->route('admin.productos.index')->with('success','Producto actualizado');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(productos $producto)
    {
        // Eliminar producto.
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success','Producto eliminado correctamente');
        //
    }
}
