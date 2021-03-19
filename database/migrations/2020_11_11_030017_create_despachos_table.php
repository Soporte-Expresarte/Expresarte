<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespachosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despachos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_hogar');
            $table->string('calle');
            $table->string('pais');
            $table->string('region');
            $table->string('comuna');
            $table->string('compania_despacho')->nullable();
            $table->string('n_seguimiento')->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('celular');
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
        Schema::dropIfExists('despachos');
    }
}
