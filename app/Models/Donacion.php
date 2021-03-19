<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Donaciones de un usuario a un proyecto en particular.
class Donacion extends Model
{
    use HasFactory;

    protected $table = 'donaciones';

    protected $fillable = [
        "cantidad", "monto_donado", "usuario_id", "premio_id","orden_id"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];


    // Relaciones

    public function usuario(){
        return $this->belongsTo(
            User::class,
            'usuario_id'
        );
    }

    public function premio(){
        return $this->belongsTo(
            Premio::class,
            'premio_id'
        );
    }

    public function orden(){
        return $this->belongsTo(
            OrdenProyecto::class,
            'orden_id'
        );
    }
}
