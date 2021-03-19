<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Models\Carro;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(array $input)
    {
        // Se encripta la contraseña
        $input['password'] = bcrypt($input['password']);

        DB::transaction(function () use ($input) {
            // Se crea una instancia de carro de compras y se asocia al usuario.
            $carro = Carro::create();
            $input['carro_id'] = $carro->id;

            // Se retorna el usuario creado.
            $user = User::create($input);

            $this->guard->login($user);
        });

        return redirect(config('fortify.home'));
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
