<?php

namespace Database\Factories;

use App\Models\Donacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cantidad' => rand(0, 5),
            'monto_donado' => rand(1000, 30000),
            'despacho_id' => rand(1, 50),
            'usuario_id' => rand(1, 3),
            'premio_id' => rand(1, 50),
        ];
    }
}
