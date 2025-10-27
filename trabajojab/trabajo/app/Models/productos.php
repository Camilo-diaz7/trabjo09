<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model

{
    use HasFactory;

    //
    protected $table='productos';
    // Campos que se pueden asignar masivamente (mass assignment)
    protected $fillable=[
        'nombre',
        'precio',
        'stock',
        'tipo_productos_id', // FK opcional que apunta a tipo_productos.id
         // campo libre para 'comestible' o 'licor'
    // Campos que se pueden asignar masivamente
    ];
    // Puedes agregar otros campos como 'categoria' si lo usas en productos

    public function tipoProductos(){
        // Relación belongsTo con el modelo tipo_productos usando la FK 'tipo_productos_id'.
    /**
     * Relación: Un producto pertenece a un tipo de producto (opcional).
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
        return $this->belongsTo(\App\Models\tipo_productos::class, 'tipo_productos_id');
    }

}
