<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProyecto extends Model
{
    use HasFactory;

    protected $table = 'imagenes_proyectos';

    protected $fillable = [
        "ruta","proyecto_id"
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
