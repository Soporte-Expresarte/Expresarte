<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        "titulo", "fecha_termino", "fecha_evento", "lugar", "descripcion", "foto_portada", "foto_evento", "usuario_id", "estado"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Obtiene el usuario creador de un evento.
    */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
