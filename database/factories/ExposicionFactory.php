<?php

namespace Database\Factories;

use App\Models\Exposicion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExposicionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exposicion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(rand(6, 10)),
            'sub_titulo' => $this->faker->sentence(rand(20, 27)),
            'descripcion' => $this->faker->paragraph(rand(24, 36)),
            'img_principal' => 'ruta',
            'img_banner' => 'ruta',
            'usuario_id' => rand(1, 4)
        ];
    }
}
