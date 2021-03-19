<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExposicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exposiciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('sub_titulo');
            $table->text('descripcion');
            $table->text('img_principal')->nullable();
            $table->text('img_banner')->nullable();
            $table->foreignId('usuario_id');

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
        Schema::dropIfExists('exposiciones');
    }
}
