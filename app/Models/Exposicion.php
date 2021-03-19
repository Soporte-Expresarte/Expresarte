<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exposicion extends Model
{
    use HasFactory;

    protected $table = 'exposiciones';

    protected $fillable = [
        'titulo',
        'sub_titulo',
        'descripcion',
        'img_principal',
        'img_banner',
        'usuario_id'
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Obtiene el usuario creador de una noticia.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function obras()
    {
        return $this->belongsToMany(
            Obra::class,
            'exposiciones_obras',
            'exposicion_id',
            'obra_id'
        );
    }
}
