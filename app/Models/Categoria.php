<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Producto;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        "nombre"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Obtiene los productos que poseen cierta categoria.
    */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
