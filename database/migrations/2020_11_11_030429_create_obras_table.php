<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
			$table->text('titulo');
			$table->text('descripcion');
			$table->string('tipo'); //Este atributo es inutil pero para borrarlo hay que cambiar el codigo :(
			$table->text('especificaciones');
			$table->foreignId('usuario_id');
            $table->foreignId('tipo_obra_id');

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
        Schema::dropIfExists('obras');
    }
}
