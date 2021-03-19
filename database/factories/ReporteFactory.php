<?php

namespace Database\Factories;

use App\Models\Reporte;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReporteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reporte::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $currentMotivo = ['Nombre indebido',
            'Precio indebido',
            'Contenido indebido',
            'Otro'];

        return [
            'motivo' => $currentMotivo[rand(0, 3)],
            'descripcion' => $this->faker->paragraph,
            'usuario_id' => rand(4, 10),
            'producto_id' => rand(1, 33),
            'artista_id' => rand(2, 4),
        ];
    }
}
