<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenProyecto extends Model
{
    use HasFactory;

    protected $table = 'ordenes_proyectos';

    protected $fillable = [
        "monto_pagado","monto_total","proyecto_id", "usuario_id","despacho_id"
    ];

    protected $hidden = [
        'updated_at', 'created_at'
    ];


    //relaciones

    public function proyecto(){
        return $this->belongsTo(
            Proyecto::class,
            'proyecto_id'
        );
    }

    public function usuario(){
        return $this->belongsTo(
            User::class,
            'usuario_id'
        );
    }

    public function despacho(){
        return $this->belongsTo(
            Despacho::class,
            'despacho_id'
        );
    }

    public function donaciones(){
        return $this->hasMany(
            Donacion::class,
            'orden_id'
        );
    }
}
