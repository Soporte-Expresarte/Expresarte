<?php

namespace App\Http\Livewire\Crowdfunding;

use Livewire\Component;

class EscogerPremiosComponent extends Component
{
    public $vista_actual;

    public $proyecto;
    public $despacho;

    public $cantidades_premio = [];
    public $donacion_adicional;
    public $donacion_total;

    public $calle;
    public $numero_hogar;
    public $comuna;
    public $region;
    public $pais;
    public $celular;

    public $info_validada;

    public function mount($proyecto,$despacho)
    {
        $this->vista_actual = "seleccionar_premios";
        $this->proyecto = $proyecto;
        $this->despacho = $despacho;

        foreach($proyecto->premios as $premio){
            $this->cantidades_premio[] = 0;
        }
        $this->donacion_adicional = 0;

        if($despacho != null){
            $this->calle = $despacho->calle;
            $this->numero_hogar = $despacho->numero_hogar;
            $this->comuna = $despacho->comuna;
            $this->region = $despacho->region;
            $this->pais = $despacho->pais;
            $this->celular = $despacho->celular;
        }
    }

    public function render()
    {
        $this->donacion_total = 0;

        if($this->donacion_adicional < 0)
            $this->donacion_adicional = 0;

        $this->donacion_adicional = intval($this->donacion_adicional);

        $this->donacion_total =  $this->donacion_adicional;
        for($i=0;$i<count($this->proyecto->premios);$i++){
            $this->cantidades_premio[$i] = intval($this->cantidades_premio[$i]);
            if($this->cantidades_premio[$i] < 0){
                $this->cantidades_premio[$i] = 0;
            }
            if($this->cantidades_premio[$i] > $this->proyecto->premios[$i]->cantidad_actual){
                $this->cantidades_premio[$i] = $this->proyecto->premios[$i]->cantidad_actual;
            }


            $this->donacion_total += $this->cantidades_premio[$i] * $this->proyecto->premios[$i]->precio_minimo;
        }
        return view('livewire.crowdfunding.escoger-premios-component');
    }

    public $rules = [
        'calle' => 'required|string|min:3|max:255',
        'numero_hogar' => 'required|numeric',
        'comuna' => 'required|string|min:3|max:255',
        'region' => 'required|string|min:3|max:255',
        'celular' => 'required|numeric|digits_between:9,9',
        'pais' => 'required|alpha|min:3|max:255',
        'donacion_total' => 'required|numeric|min:1000'

    ];

    protected $messages = [

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

        // Donacion total
        'donacion_total.min'               => 'La donacion debe ser de al menos $1000 CLP',
    ];



    public function vistaPremios(){

        // no necesita validaciones para estar aqui

        $this->vista_actual = "seleccionar_premios";
    }

    public function vistaDespacho(){

        $this->validateOnly('donacion_total');

        $this->vista_actual = "seleccionar_despacho";

    }

    public function vistaPago(){

        $info_validada = $this->validate();

        $this->vista_actual = "seleccionar_pago";
    }

    public function pagoWebpay(){

        //pago webpay
        dd("AUN NO IMPLEMENTADO :c");
    }

    public function comprarPremios(){

        $datos = array(
            'proyecto' => $this->proyecto,
            'donacion_adicional' => $this->donacion_adicional,
            'donacion_total' => $this->donacion_total,
            'calle' => $this->calle,
            'numero_hogar' => $this->numero_hogar,
            'comuna' => $this->comuna,
            'region' => $this->region,
            'pais' => $this->pais,
            'celular' => $this->celular,
        );
        //llamado al metodo del controlador
        app('App\Http\Controllers\ProyectoController')->crearOrden($datos,$this->cantidades_premio);
    }


}
