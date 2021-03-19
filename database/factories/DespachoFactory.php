<?php

namespace Database\Factories;

use App\Models\Despacho;
use Illuminate\Database\Eloquent\Factories\Factory;

class DespachoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Despacho::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'calle' => $this->faker->streetName,
            'numero_hogar' => rand(100, 5000),
            'comuna' => $this->faker->city,
            'region' => $this->faker->state,
            'pais' => $this->faker->country,
            'compania_despacho' => $this->faker->company,
            "n_seguimiento"=> rand(1000000, 5000000),
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            "celular" => $this->faker->phoneNumber,
        ];
    }
}
