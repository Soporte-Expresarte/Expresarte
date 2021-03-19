<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    use HasFactory;

    protected $table = 'obras';

    //El atributo "tipo" es inutil pero para borrarlo hay que cambiar el codigo :(
    protected $fillable = [
        "titulo", "descripcion", "tipo", "especificaciones", "usuario_id", "tipo_obra_id", "estado"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Obtiene el usuario propietario de una obra (artistas).
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Obtiene el tipo de una obra.
     */
    public function tipo_obra()
    {
        return $this->belongsTo(TipoObra::class, 'tipo_obra_id');
    }

    /**
     * Una Obra tiene muchas ImagenObra
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imagenes()
    {
        return $this->hasMany(
            ImagenObra::class, 'obra_id'
        );
    }

    public function exposiciones()
    {
        return $this->belongsToMany(
            Exposicion::class,
            'exposiciones_obras',
            'obra_id',
            'exposicion_id'
        );
    }
}
