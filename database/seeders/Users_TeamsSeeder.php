<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Carro;
use App\Models\Team;
use Illuminate\Support\Str;

class Users_TeamsSeeder extends Seeder
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
            'apellido' => 'Expresarte',
            'email' => 'admin@gmail.com',
            'apodo' => 'administrador_expresarte',
            'current_team_id' => 1,
            'email_verified_at' => now(),
            'carro_id' => 1,
            'password' => bcrypt('adminEXP123'), // password
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

        // Artista.
        User::create([
            'name' => 'Petter',
            'apellido' => 'Nottrott',
            'email' => 'artista@gmail.com',
            'apodo' => 'artista1',
            'fecha_nacimiento'=> '1972-12-01',
            'current_team_id' => 2,
            'perfil_id' => 1,
            'carro_id' => 2,
            'email_verified_at' => now(),
            'password' => bcrypt('artistaEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Artista2.
        User::create([
            'name' => 'Rie',
            'apellido' => 'Kono',
            'email' => 'artista2@gmail.com',
            'apodo' => 'artista2',
            'fecha_nacimiento'=> '1961-09-22',
            'current_team_id' => 2,
            'perfil_id' => 2,
            'carro_id' => 3,
            'email_verified_at' => now(),
            'password' => bcrypt('artistaEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Artista3.
        User::create([
            'name' => 'Froydis',
            'apellido' => 'Aarseth',
            'email' => 'artista3@gmail.com',
            'apodo' => 'artista3',
            'fecha_nacimiento'=> '1955-01-13',
            'current_team_id' => 2,
            'perfil_id' => 3,
            'carro_id' => 4,
            'email_verified_at' => now(),
            'password' => bcrypt('artistaEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Usuario con cuenta.
        User::create([
            'name' => 'Diego',
            'apellido' => 'Vega',
            'email' => 'usuario@gmail.com',
            'apodo' => 'usuario',
            'current_team_id' => 3,
            'carro_id' => 5,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);


        // Usuario con cuenta.
        User::create([
            'name' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'usuario2@gmail.com',
            'apodo' => 'usuario2',
            'current_team_id' => 3,
            'carro_id' => 6,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Usuario con cuenta.
        User::create([
            'name' => 'Constanza',
            'apellido' => 'Gonzales',
            'email' => 'usuario3@gmail.com',
            'apodo' => 'usuario3',
            'current_team_id' => 3,
            'carro_id' => 7,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Usuario con cuenta.
        User::create([
            'name' => 'Camila',
            'apellido' => 'Zepeda',
            'email' => 'usuario4@gmail.com',
            'apodo' => 'usuario4',
            'current_team_id' => 3,
            'carro_id' => 8,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Usuario con cuenta.
        User::create([
            'name' => 'Maria',
            'apellido' => 'Antonieta',
            'email' => 'usuario5@gmail.com',
            'apodo' => 'usuario5',
            'current_team_id' => 3,
            'carro_id' => 9,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Usuario con cuenta.
        User::create([
            'name' => 'Daniela',
            'apellido' => 'Charmander',
            'email' => 'usuario6@gmail.com',
            'apodo' => 'usuario6',
            'current_team_id' => 3,
            'carro_id' => 10,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Usuario con cuenta.
        User::create([
            'name' => 'Manuel',
            'apellido' => 'Contreras',
            'email' => 'usuario7@gmail.com',
            'apodo' => 'usuario7',
            'current_team_id' => 3,
            'carro_id' => 11,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Usuario con cuenta.
        User::create([
            'name' => 'Darío',
            'apellido' => 'Acosta',
            'email' => 'usuario8@gmail.com',
            'apodo' => 'usuario8',
            'current_team_id' => 3,
            'carro_id' => 12,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Usuario con cuenta.
        User::create([
            'name' => 'Penelope',
            'apellido' => 'Cifuentes',
            'email' => 'usuario9@gmail.com',
            'apodo' => 'usuario9',
            'current_team_id' => 3,
            'carro_id' => 13,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

        // Usuario con cuenta.
        User::create([
            'name' => 'Macarena',
            'apellido' => 'Astorga',
            'email' => 'usuario10@gmail.com',
            'apodo' => 'usuario10',
            'current_team_id' => 3,
            'carro_id' => 14,
            'email_verified_at' => now(),
            'password' => bcrypt('usuarioEXP123'), // password
            'remember_token' => Str::random(10),
        ]);

    }
}
