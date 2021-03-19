<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = 'noticias';

    protected $fillable = [
        "titulo",
        "sub_titulo",
        "bajada",
        "cuerpo",
        "imagen_path",
        "portada_path",
        "fecha_noticia",
        "usuario_id"
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

    /**
     * Una Noticia pertenece a muchos Tag
     */
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'noticias_tags',
            'noticia_id',
            'tag_id')
            ->withTimestamps();
    }
}
