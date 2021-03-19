<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    use HasFactory;

    protected $table = 'premios_proyectos';

    protected $fillable = [
        "nombre","descripcion","precio_minimo","cantidad_actual", "cantidad_maxima","proyecto_id"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];


    // Relaciones

    public function proyecto(){
        $this->belongsTo(
            Proyecto::class,
            'proyecto_id'
        );
    }


}
