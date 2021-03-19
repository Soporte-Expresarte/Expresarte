<?php

namespace Database\Factories;

use App\Models\Perfil;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerfilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Perfil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $perfil1 = Perfil::create([
            'descripcion' => $this->faker->paragraph(rand(12, 26)),
            'cita' => $this->faker->sentence(rand(14, 24)),
            'facebook' => 'Pnot777',
            'instagram' => 'Pnot777',
            'twitter' => 'Pnot777',
            'foto_portada' => 'https://cdn.singulart.com/artists/pictures/cropped/studio/base/artist_studio_2493_a280d1e12941c0a3f9f074ed61549ab6.jpeg',
            'foto_artista' => 'https://cdn.singulart.com/artists/pictures/cropped/artwork/base/artist_artwork_2493_a143e778b7d8a2bb6d5a721dbd90882a.jpeg',
        ]);

        $perfil2 = Perfil::create([
            'descripcion' => $this->faker->paragraph(rand(8, 14)),
            'cita' => $this->faker->sentence(rand(6, 10)),
            'facebook' => 'Pnot777',
            'instagram' => 'Pnot777',
            'twitter' => 'Pnot777',
            'foto_portada' => 'https://cdn.singulart.com/artists/v2/pictures/cropped/studio/base/4477_studio_139d567a669d3e6d1dae5dd785041dc2.jpeg',
            'foto_artista' => 'https://cdn.singulart.com/artists/pictures/cropped/artwork/base/artist_artwork_4477_9ae16a20b744c76b8383455adfc409e1.jpeg',
        ]);

        return [
            'descripcion' => $this->faker->paragraph(rand(8, 14)),
            'cita' => $this->faker->sentence(rand(6, 10)),
            'facebook' => 'Pnot777',
            'instagram' => 'Pnot777',
            'twitter' => 'Pnot777',
            'foto_portada' => 'https://cdn.singulart.com/artists/v2/pictures/cropped/studio/base/22703_studio_12cfd92cb8676c05b88ada77aa1b267f.jpeg',
            'foto_artista' => 'https://cdn.singulart.com/artists/v2/pictures/cropped/artwork/base/22703_artwork_45edab2b0f772de002623779682d761e.jpeg',
        ];
    }
}
