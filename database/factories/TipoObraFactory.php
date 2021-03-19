<?php

namespace Database\Factories;

use App\Models\TipoObra;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipoObraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoObra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tiposObra = ['Renacimiento', 'Postmodernista', 'Abstracto', 'Barroco', 'Cubismo', 'Dadaista', 'Pop', 'Surrealista', 'Impresionista', 'Hiperrealismo'];

        return [
            'nombre' => $tiposObra[rand(0, 9)]
        ];
    }
}
