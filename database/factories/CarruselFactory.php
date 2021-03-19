<?php

namespace Database\Factories;

use App\Models\Carrusel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarruselFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carrusel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => rand(1, 2) == 1 ? $this->faker->sentence(rand(6, 10)) : null,
            'descripcion' => rand(1, 2) == 1 ? $this->faker->sentence(rand(20, 27)) : null,
            'link' => rand(1, 2) == 1 ? '#' : null,
            'banner' => 'sin banner'
        ];
    }
}
