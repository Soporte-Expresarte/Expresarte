<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrusel extends Model
{
    use HasFactory;

    protected $table = 'carruseles';

    protected $fillable = [
        'titulo',
        'descripcion',
        'link',
        'banner'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carruselCompleto()
    {
        return $this->belongsTo(CarruselCompleto::class, 'carrusel_completo_id');
    }
}
