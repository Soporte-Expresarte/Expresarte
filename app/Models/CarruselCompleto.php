<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarruselCompleto extends Model
{
    use HasFactory;

    protected $table = 'carruseles_completos';

    protected $fillable = [
        'titulo',
        'descripcion',
        'banner'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    /**
     * Obtiene el usuario creador de una noticia.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carruseles()
    {
        return $this->hasMany(Carrusel::class, 'carrusel_completo_id');
    }


}
