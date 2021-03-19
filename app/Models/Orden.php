<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes';

    protected $fillable = [
        "usuario_id", "despacho_id", "monto_total"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Una órden de compra pertenece a un usuario
     */
    public function usuario(){
        return $this->hasOne(User::class, 'usuario_id');
    }

    /**
    * Una órden esta asociada a un despacho.
    */
    public function despacho(){
        return $this->belongsTo(Despacho::class, 'despacho_id');
    }

    /**
    * Una orden esta asociada a muchos productos.
    */
    public function productos(){
        return $this->belongsToMany(Producto::class, 'ordenes_productos', 'orden_id', 'producto_id')->withTimestamps()->withPivot("cantidad","enviado");
    }

}
