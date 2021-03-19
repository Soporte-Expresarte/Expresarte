<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';

    protected $fillable = [
        "motivo", "descripcion", "usuario_id", "producto_id", "artista_id"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Obtiene el usuario que reporto el producto.
    */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    /**
     * Obtiene el artista del producto reportado.
    */
    public function artista()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    /**
     * Obtiene el producto reportado.
    */
    public function producto() 
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    
}
