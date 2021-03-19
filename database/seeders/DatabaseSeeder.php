<?php

namespace Database\Seeders;

use App\Models\Exposicion;
use App\Models\ImagenObra;
use App\Models\Promocion;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriasTableSeeder::class,
            TemasTableSeeder::class,
            Users_TeamsSeeder::class,
            DespachosTableSeeder::class,
            DonacionesTableSeeder::class,
            EventosTableSeeder::class,
            ImagenesProyectosSeeder::class,
            NoticiasTableSeeder::class,
            // las obras se hacen en las imagenesObras
            //ObrasTableSeeder::class,
            TagTableSeeder::class,
            PerfilesTableSeeder::class,
            PremiosTableSeeder::class,
            OrdenesTableSeeder::class,
            ImagenesProductosTableSeeder::class,
            CarrosTableSeeder::class,
            // los productos se hacen en las imagenesProductos
            // ProductosTableSeeder::class,
            PromocionTableSeeder::class,
            ProyectosTableSeeder::class,
            TiposObrasTableSeeder::class,
            ImagenesObrasTableSeeder::class,
            ReportesTableSeeder::class,
            ExposicionTableSeeder::class,
            CarruselTableSeeder::class
        ]);

        // Seeders que se ejecutarían solo la primera vez cuando ya se esté en producción (?)
        // $this->call([
        //     CategoriasTableSeeder::class,
        //     TemasTableSeeder::class,
        //     ProductionSeeder::class,
        //     TiposObrasTableSeeder::class,
        // ]);
    }
}
