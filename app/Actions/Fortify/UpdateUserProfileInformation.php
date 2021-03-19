<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', "alpha", 'min:3', 'max:255'],
            'apellido' => ['required', 'string', 'alpha', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'apodo' => ['required', Rule::unique('users')->ignore($user->id)],
            'rut' => ['required', 'cl_rut', 'regex:/^([1-9][0-9]{6,7}-[0-9k])$/', Rule::unique('users')->ignore($user->id)],
            'telefono' => ['nullable', 'integer', 'digits_between:9,9'],
            'fecha_nacimiento' => ['nullable', 'date', 'before_or_equal:today'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ], [
            // Correo
            'email.required'                   => 'El correo es un campo obligatorio !',
            'email.unique'                     => 'Este correo ya se encuentra registrado !',
            'email.email'                      => 'La dirección de correo no es válida !',
                                            
            // Apodo  
            'apodo.required'                   => 'El apodo es un campo obligatorio !',
            'apodo.unique'                     => 'Este apodo ya se encuentra registrado !',

            // Contraseña  
            'password.required'                => 'La contraseña es un campo obligatorio !',
            'password.min'                     => 'La contraseña debe tener mínimo 8 caracteres.',
            'password.max'                     => 'La contraseña debe tener máximo 255 caracteres.',
            'password_confirmation.required'   => 'La confirmación de la contraseña es un campo obligatorio !',
            'password_confirmation.same'       => 'Debe coincidir con la contraseña ingresada !',

            // Rut
            'rut.required'                     => 'El rut es un campo obligatorio !',
            'rut.cl_rut'                       => 'El rut no es válido.',
            'rut.regex'                        => 'El rut debe ser escrito usando guión.',
            'rut.unique'                       => 'Este rut ya se encuentra registrado !',

            // Nombre  
            'name.required'                    => 'El nombre es un campo obligatorio !',
            'name.alpha'                      => 'El nombre no pueden contener números.',
            'name.min'                         => 'El nombre debe contener más de 3 carácteres !',
            'name.max'                         => 'El nombre debe tener como máximo 255 caracteres.',

            // Apellido  
            'apellido.required'                => 'El apellido es un campo obligatorio !',
            'apellido.alpha'                  => 'El apellido no pueden contener números.',
            'apellido.min'                     => 'El apellido debe contener más de 3 carácteres !',
            'apellido.max'                     => 'El apellido debe tener como máximo 255 caracteres.',

            // Telefono
            'telefono.integer'                 => 'El telefono debe ser un número !',
            'telefono.digits_between'          => 'El telefono debe tener como mínimo 9 caracteres !',

            //Fecha Nacimiento
            'fecha_nacimiento.date' => 'Debe ingresar una fecha válida.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento debe ser igual o anterior a la fecha actual.',
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'apellido' => $input['apellido'],
                'email' => $input['email'],
                'apodo' => $input['email'],
                'rut' => $input['rut'],
                'telefono' => $input['telefono'],
                'fecha_nacimiento' => $input['fecha_nacimiento'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'apellido' => $input['apellido'],
            'email' => $input['email'],
            'apodo' => $input['email'],
            'rut' => $input['rut'],
            'telefono' => $input['telefono'],
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
