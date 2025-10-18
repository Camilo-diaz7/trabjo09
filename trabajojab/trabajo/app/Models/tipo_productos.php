<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_productos extends Model
{

    use HasFactory;
    //
    protected $table='tipo_productos';
    // Campos que se pueden asignar masivamente
    protected $fillable=[
        'nombre',
        'descripcion',
        'categoria' // comestible o licor
    ];
    /**
     * Relación: Un tipo de producto tiene muchos productos.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos(){
        return $this->hasMany(productos::class,'tipo_productos_id');
    }
}
