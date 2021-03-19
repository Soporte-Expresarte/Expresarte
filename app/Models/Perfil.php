<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfiles';

    protected $fillable = [
        "descripcion", "cita", "facebook", "instagram", "twitter", "foto_portada", "foto_artista"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Obtiene el usuario asociado a un perfil.
    */
    public function usuario()
    {
        return $this->hasOne(User::class, 'perfil_id');
    }
}
