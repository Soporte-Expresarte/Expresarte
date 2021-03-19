<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        "titulo","descripcion","sub_titulo","estado", "aprobado", "fecha_inicio",
        "fecha_limite","duracion_dias","monto_actual","meta","url_video",
        "imagen_portada","contador_visitas","usuario_id"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];


    // Relaciones

    public function publicador(){
        return $this->belongsTo(
            User::class,
            'usuario_id'
        );
    }

    public function premios(){
        return $this->hasMany(
            Premio::class,
            'proyecto_id'
        );
    }

    public function imagenes(){
        return $this->hasMany(
            ImagenProyecto::class,
            'proyecto_id'
        );
    }

    public function ordenesProyecto(){
        return $this->hasMany(
            OrdenProyecto::class,
            'proyecto_id'
        );
    }

    public static function buscar($contenido){
        return empty($contenido) ? static::query()
            : static::query()->where('titulo','like','%'.$contenido.'%');
    }

}
