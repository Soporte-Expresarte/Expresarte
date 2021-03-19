<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'nombre'
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Un Tag pertenece a muchas Noticias
     */
    public function noticias()
    {
        return $this->belongsToMany(Noticia::class,
            'noticias_tags',
            'tag_id',
            'noticia_id')
            ->withTimestamps();
    }
}
