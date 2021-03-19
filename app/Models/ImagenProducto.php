<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    use HasFactory;

    protected $table = 'imagenes_productos';

    protected $fillable = [
        "ruta", "producto_id"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];


    /**
     * Obtiene el producto asociado a una imagen.
    */
    public function producto()
    {
        return $this->belongsTo(Producto::class,'producto_id');
    }
}
