<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarruselesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carruseles', function (Blueprint $table) {
            $table->id();

            $table->string('titulo')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('link')->nullable();
            $table->text('banner');

            $table->foreignId('carrusel_completo_id');

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
        Schema::dropIfExists('carruseles');
    }
}
