<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_proyectos', function (Blueprint $table) {
            $table->id();

            $table->integer('monto_pagado')->default(0);
            $table->integer('monto_total')->default(0);
            $table->foreignId('proyecto_id');
            $table->foreignId('usuario_id');
            $table->foreignId('despacho_id')->nullable()->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes_proyectos');
    }
}
