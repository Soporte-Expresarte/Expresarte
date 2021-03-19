<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $table = 'carros';

    protected $fillable = [
        "monto_total"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Obtiene el usuario asociado a un carro.
    */
    public function usuario()
    {
        return $this->hasOne(User::class, 'carro_id');
    }

    /**
     * Obtiene los productos pertenecientes a un carro.
    */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'productos_carros', 'carro_id', 'producto_id')->withTimestamps()->withPivot("cantidad");
    }

}
