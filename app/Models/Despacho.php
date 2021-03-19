<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
    use HasFactory;

    protected $table = 'despachos';

    protected $fillable = [
        "calle", "numero_hogar", "comuna", "region", "pais", "compania_despacho","n_seguimiento","nombre","apellido", "celular"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
    * Un despacho posee una órden.
    */
    public function ordenes(){
        return $this->hasMany(
            Orden::class,
            'despacho_id');
    }

    /**
    * Un despacho esta asociado a una donación.
    */
    public function donacion(){
        return $this->hasOne(
            Donacion::class,
            'donacion_id');
    }

    /**
    * Un despacho esta asociado a muchas OrdenesProyecto
    */
    public function ordenesProyecto(){
        return $this->hasMany(
            OrdenProyecto::class,
            'despacho_id');
    }
}
