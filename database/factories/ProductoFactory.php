<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str as Str;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $nombre = $this->faker->unique(true)->sentence(rand(3, 8), $variableNbWords = true);

        return [
            'nombre' => $nombre,
            'descripcion' => $this->faker->paragraph(rand(7, 21)),
            'slug' => Str::slug($nombre),
            // Si se crean más usuarios, asignar a distintos usuarios artistas.
            'usuario_id' => rand(2, 4),
            'categoria_id' => rand(1, Categoria::count()),
            'tema_id' => rand(1, 15),
            'largo' => rand(0, 10),
            'ancho' => rand(0, 10),
            'alto' => rand(0, 10),
            'precio' => rand(10000, 100000),
            'stock' => rand(0, 100),
            'vendidos' => rand(0, 100),
        ];
    }
}
