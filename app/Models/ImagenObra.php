<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenObra extends Model
{
    use HasFactory;

    /**
     * Nombre de la columna correspondiente ne la base de datos
     * @var string
     */
    protected $table = 'imagenes_obras';

    /**
     * Atributos permitidos para asignación masiva
     * @var string[]
     */
    protected $fillable = [
        'ruta',
        'obra_id'
    ];

    /**
     * Atributos no mostrados en la serialización del modelo
     * @var string[]
     */
    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    /**
     * Una imagenObra pertenece a una Obra
     */
    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

}
