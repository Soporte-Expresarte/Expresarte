<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {

            $table->id();

            $table->string('titulo');
            $table->text('sub_titulo');
            $table->longText('descripcion');

            $table->BigInteger('monto_actual')->default(0);
            $table->BigInteger('meta');

            $table->dateTime('fecha_inicio',0)->nullable();
            $table->dateTime('fecha_limite',0)->nullable();
            $table->integer('duracion_dias');

            $table->enum('estado', ['EN CURSO','FINALIZADO','CANCELADO'])->default('EN CURSO');

            $table->enum('aprobado', ['SI','NO','PENDIENTE'])->default('PENDIENTE');

            $table->text('url_video')->nullable();
            $table->text('imagen_portada')->nullable();

            $table->BigInteger('contador_visitas')->default(0);

            $table->timestamps();

            $table->foreignId('usuario_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
