<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
			$table->dateTime('fecha_evento');
			$table->dateTime('fecha_termino');
			$table->string('lugar')->nullable();
			$table->text('descripcion')->nullable();
            $table->text('foto_portada')->nullable();
            $table->text('foto_evento')->nullable();
            $table->foreignId('usuario_id');

            $table->enum('estado', ['APROBADO','RECHAZADO','PENDIENTE'])->default('PENDIENTE');

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
        Schema::dropIfExists('eventos');
    }
}
