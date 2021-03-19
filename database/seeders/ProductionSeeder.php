<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Str;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrador.
        User::create([
            'name' => 'Mesin',
            'apellido' => 'Cortes',
            'email' => 'admin@gmail.com',
            'apodo' => 'mesin-expresarte',
            'current_team_id' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('admin1234@'), // password
            'remember_token' => Str::random(10),
        ]);
        
        // Equipos de Administradores, artistas y usuarios logueados.
        Team::create([
            'user_id' => 1,
            'name' => 'Administradores',
            'personal_team' => false,
        ]);
        Team::create([
            'user_id' => 1,
            'name' => 'Artistas',
            'personal_team' => false,
        ]);
        Team::create([
            'user_id' => 1,
            'name' => 'Usuarios',
            'personal_team' => false,
        ]);
    }
}
