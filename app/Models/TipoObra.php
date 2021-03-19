<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoObra extends Model
{
    use HasFactory;

    protected $table = 'tipos_obras';

    protected $fillable = [
        "nombre"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Obtiene las obras que poseen cierto tipo.
    */
    public function obras()
    {
        return $this->hasMany(obra::class, 'tipo_obra_id');
    }
}
