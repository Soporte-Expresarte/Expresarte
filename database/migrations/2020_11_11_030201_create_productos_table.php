<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->text('descripcion');
            $table->string('slug')->unique();

            $table->foreignId('usuario_id');
            $table->foreignId('categoria_id');
            $table->foreignId('tema_id');

            $table->float("largo");
            $table->float("ancho");
            $table->float("alto")->nullable();

            $table->bigInteger('precio');
            $table->integer('stock');
            $table->integer('vendidos');
            $table->boolean('en_venta')->default(1);
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
        Schema::dropIfExists('productos');
    }
}
