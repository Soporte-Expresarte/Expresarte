<?php

namespace App\Http\Livewire\Market;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProcesoDespacho extends Component
{
    // Información que debe mostrar
    public $informacion_activa = "formulario_despacho";

    // Datos de despacho
    public $nombre;
    public $apellido;
    public $calle;
    public $numero_hogar;
    public $comuna;
    public $region;
    public $celular;
    public $pais;

    public $carrito;

    public function mount() {
        $this->carrito = Auth::user()->carro;
    }

    public function render()
    {
        return view('livewire.market.proceso-despacho');
    }

    public $rules = [
        'nombre' => 'required|alpha|min:3|max:255',
        'apellido' => 'required|alpha|min:3|max:255',
        'calle' => 'required|string|min:3|max:255',
        'numero_hogar' => 'required|numeric',
        'comuna' => 'required|string|min:3|max:255',
        'region' => 'required|string|min:3|max:255',
        'celular' => 'required|numeric|digits_between:9,9',
        'pais' => 'required|alpha|min:3|max:255',
    ];

    protected $messages = [
        // Nombre
        'nombre.required'               => 'El nombre es un campo obligatorio.',
        'nombre.alpha'                  => 'Nombre inválido. No use números ni espacios.',
        'nombre.min'                    => 'El nombre debe contener más de 3 carácteres.',
        'nombre.max'                    => 'El nombre debe tener como máximo 255 caracteres.',

        // Apellido
        'apellido.required'             => 'El apellido es un campo obligatorio.',
        'apellido.alpha'                => 'Apellido inválido. No use números ni espacios.',
        'apellido.min'                  => 'El apellido debe contener más de 3 carácteres.',
        'apellido.max'                  => 'El apellido debe tener como máximo 255 caracteres.',

        // Calle
        'calle.required'                => 'La calle es un campo obligatorio.',
        'calle.string'                   => 'La calle no debe contener números.',
        'calle.min'                     => 'La calle debe contener como mínimo 3 caracteres',
        'calle.max'                     => 'La calle debe contener como máximo 255 caracteres',

        // Numero de hogar
        'numero_hogar.required'         => 'El número es obligatorio.',
        'numero_hogar.numeric'          => 'Debe ser un número.',

        // Comuna
        'comuna.required'               => 'La comuna es un campo obligatorio.',
        'comuna.string'                  => 'La comuna no debe contener números.',
        'comuna.min'                    => 'La comuna debe contener como mínimo 3 caracteres',
        'comuna.max'                    => 'La comuna debe contener como máximo 255 caracteres',

        // Región
        'region.required'               => 'La region es un campo obligatorio.',
        'region.string'                  => 'La region no debe contener números.',
        'region.min'                    => 'La region debe contener como mínimo 3 caracteres',
        'region.max'                    => 'La region debe contener como máximo 255 caracteres',

        // Celular
        'celular.required'              => 'El celular es un campo obligatorio.',
        'celular.numeric'               => 'El telefono debe ser un número.',
        'celular.digits_between'        => 'El telefono debe tener 9 caracteres.',

        // País
        'pais.required'                 => 'El pais es un campo obligatorio.',
        'pais.alpha'                    => 'El pais no debe contener números.',
        'pais.min'                      => 'El pais debe contener como mínimo 3 caracteres',
        'pais.max'                      => 'El pais debe contener como máximo 255 caracteres',
    ];

    /**
     * Actualiza un campo en tiempo real.
     */
    public function updated($nombrePropiedad)
    {
        $this->validateOnly($nombrePropiedad);
    }

    /**
     * Cambia la vista y muestra el instructivo de pago.
     */
    public function mostrarInstructivoPago() {
        // Valida los campos antes de pasar a mostrar el instructivo de pago.
        $this->validate();

        $this->informacion_activa = "instructivo_pago";
    }

    /**
     * Cambia la vista y muestra el formulario de despacho.
     */
    public function mostrarFormularioDespacho() {
        $this->informacion_activa = "formulario_despacho";
    }

    /**
     * Inicia el flujo para cobrar el carrito, realizar el pago, generar despacho y órdenes.
     * TODO: Falta que ocurra todo el proceso de Webpay antes de generar dichas entidades.
     */
    public function submit() {
        $info_validada = $this->validate();

        // Añade el carrito y productos para posteriormente leer sus productos y monto total.
        $info_validada['carrito'] = $this->carrito;

        // Registra el producto en el sistema.
        app('App\Http\Controllers\MarketController')->generarOrden($info_validada);
    }
}
