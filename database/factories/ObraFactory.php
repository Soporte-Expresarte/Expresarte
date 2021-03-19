<?php

namespace Database\Factories;

use App\Models\Obra;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Obra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $aprobado = ['APROBADO',
            'PENDIENTE',
            'RECHAZADO'];

        $tipos = ['Abstracto',
            'Barroco',
            'Cubismo',
            'Dadaista',
            'Hiperrealismo',
            'Impresionista',
            'Pop',
            'Renacimiento',
            'Surrealista',
            'Postmodernista'
        ];

        $tipoNumero = rand(0, 9);

        return [
            'titulo' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph((rand(10, 20)), true),
            'tipo' => $tipos[$tipoNumero],
            'especificaciones' => $this->faker->paragraph((rand(8, 12)), true),
            'usuario_id' => rand(2, 4),
            'tipo_obra_id' => $tipoNumero + 1,
            'estado' => $aprobado[rand(0, 1)],
        ];
    }
}
