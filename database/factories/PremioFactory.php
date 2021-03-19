<?php

namespace Database\Factories;

use App\Models\Premio;
use Illuminate\Database\Eloquent\Factories\Factory;

class PremioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Premio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'descripcion' => $this->faker->paragraph,
            'precio_minimo' => rand(10000, 100000),
            'cantidad_actual' => rand(0,30),
            'cantidad_maxima' => rand(30,50),
            'proyecto_id' => rand(1, 50),
        ];
    }
}
