<?php

namespace Database\Factories;

use App\Models\Tema;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tema::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $temas = ['Abstracción','Animales', 'Autorretrato', 'Conceptual', 'Cultura pop',
                'Desnudo', 'Fantasía', 'Era digital', 'Historia y política', 'Naturaleza', 'Paisajismo',
                'Provocativo', 'Religión', 'Retrato', 'Street art', 'Urbano'
        ];

        return [
            'nombre' => $temas[rand(0, 15)]
        ];
    }
}
