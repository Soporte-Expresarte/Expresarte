<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->enum('motivo', ['Nombre indebido','Precio indebido','Contenido indebido', 'Otro'])->default('Otro');
            $table->text('descripcion')->nullable();
            $table->foreignId('producto_id');
            $table->foreignId('usuario_id');
            $table->foreignId("artista_id");
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
        Schema::dropIfExists('reportes');
    }
}
