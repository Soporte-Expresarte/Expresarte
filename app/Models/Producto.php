<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        "nombre",
        "descripcion",
        "slug",
        "categoria_id",
        'usuario_id',
        "tema_id",
        "largo",
        "ancho",
        "alto",
        "precio",
        "stock",
        "vendidos",
        "en_venta"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    /**
     * Obtiene el artista que publicó un producto.
     */
    public function artista()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Obtiene la categoria del producto.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Obtiene los carros en los que está un producto.
     */
    public function carros()
    {
        return $this->belongsToMany(Carro::class, 'productos_carros', 'producto_id', 'carro_id')->withTimestamps()->withPivot("cantidad");
    }

    /**
     * Obtiene las imagenes asociadas a un producto.
     */
    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'producto_id');
    }

    /**
     * Obtiene el tema del producto.
     */
    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_id');
    }

    /**
     * Obtiene las ordenes asociadas a un producto.
     */
    public function ordenes()
    {
        return $this->belongsToMany(Orden::class, 'ordenes_productos', 'producto_id', 'orden_id')->withTimestamps()->withPivot("cantidad", "enviado");
    }

    /**
     * Un Tag pertenece a muchas Noticias
     */
    public function promocions()
    {
        return $this->belongsToMany(
            Promocion::class,
            'productos_promocions',
            'producto_id',
            'promocion_id')
            ->withTimestamps();
    }

}
