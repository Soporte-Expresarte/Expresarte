<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Carro;

class FormularioRegistro extends Component
{

    public $email = "";
    public $apodo = "";
    public $password = "";
    public $password_confirmation = "";
    public $rut = "";
    public $name = "";
    public $apellido = "";
    public $telefono = "";
    public $fecha_nacimiento = null;
    public $current_team_id;
    
    public function mount() {
        // Append the requested resource location to the URL
        if (Auth::user()) $this->current_team_id = 2;
        else $this->current_team_id = 3;
    }
    
    public function render()
    {
        return view('livewire.formulario-registro');
    }

    public $rules = [
        'email' => 'email:rfc,dns|required|max:255|unique:users,email',
        'apodo' => 'required|unique:users,apodo',
        'password' => 'required|min:8|max:255',
        'password_confirmation' => 'required|same:password',
        'rut' => 'required|cl_rut|regex:/^([1-9][0-9]{6,7}-[0-9k])$/|unique:users,rut',
        'name' => 'required|alpha|min:3|max:255',
        'apellido' => 'required|alpha|min:3|max:255',
        'telefono' => 'nullable|integer|digits_between:9,9',
        'fecha_nacimiento' => 'nullable|date|before_or_equal:today',
    ];

    protected $messages = [
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
        'name.alpha'                       => 'El nombre no puede contener números.',
        'name.min'                         => 'El nombre debe contener más de 3 carácteres !',
        'name.max'                         => 'El nombre debe tener como máximo 255 caracteres.',
  
        // Apellido  
        'apellido.required'                => 'El apellido es un campo obligatorio !',
        'apellido.alpha'                   => 'El apellido no pueden contener números.',
        'apellido.min'                     => 'El apellido debe contener más de 3 carácteres !',
        'apellido.max'                     => 'El apellido debe tener como máximo 255 caracteres.',

        // Telefono
        'telefono.integer'                 => 'El telefono debe ser un número !',
        'telefono.digits_between'          => 'El telefono debe tener 9 caracteres !',

        //Fecha Nacimiento
        'fecha_nacimiento.date' => 'Debe ingresar una fecha válida.',
        'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento debe ser igual o anterior a la fecha actual.',
    ];

    public function updated($nombrePropiedad)
    {
        $this->validateOnly($nombrePropiedad);
    }

    public function submit() {
        $info_validada = $this->validate();
        $info_validada['current_team_id'] = $this->current_team_id;

        // Si no se ingresó teléfono, se define como null.
        if ($info_validada['telefono'] == "") $info_validada['telefono'] = null;

        // Crea al usuario dependiendo de si es un usuario normal o artista.
        if ($this->current_team_id == 2) app('App\Http\Controllers\AdminController')->registrarArtista($info_validada);
        else app('App\Actions\Fortify\CreateNewUser')->create($info_validada);
    }

}
