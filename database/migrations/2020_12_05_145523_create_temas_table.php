<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temas', function (Blueprint $table) {
            $table->id();
            $table->enum('nombre', [
                'Abstracción','Animales', 'Autorretrato', 'Conceptual', 'Cultura pop',
                'Desnudo', 'Fantasía', 'Era digital', 'Historia y política', 'Naturaleza', 'Paisajismo',
                'Provocativo', 'Religión', 'Retrato', 'Street art', 'Urbano'
            ])->default('Fantasía')->unique();
            $table->string('slug')->unique();
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
        Schema::dropIfExists('temas');
    }
}
