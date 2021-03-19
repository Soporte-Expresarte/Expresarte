<?php

namespace Database\Factories;

use App\Models\ImagenProyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenProyectoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImagenProyecto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ruta' => $this->faker->imageUrl(),
            'proyecto_id' => rand(1, 50),
        ];
    }
}
