<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promocions';

    protected $fillable = [
        "titulo",
        "descripcion",
        "imagen_path",
        "banner_path",
        "bloque",
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Una Promocion pertenece a muchos Productos
     */
    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
            'productos_promocions',
            'promocion_id',
            'producto_id')
            ->withTimestamps();
    }
}
