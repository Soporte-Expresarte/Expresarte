<?php

namespace App\Http\Livewire\Galeria;

use Livewire\Component;
use Livewire\WithFileUploads;

class FormCreateEvento extends Component
{
    use WithFileUploads;

    public $titulo;
    public $descripcion;
    public $fecha_inicio;
    public $fecha_termino;
    public $lugar;
    public $foto_portada;
    public $foto_evento;

    public function render()
    {
        return view('livewire.galeria.form-create-evento');
    }

    public $rules = [
        'titulo' => 'required|min:3',
        'descripcion' => 'required|min:10',
        'fecha_inicio' =>  'required',
        'fecha_termino' =>  'required',
        'lugar' => 'required|min:3',
        'foto_portada' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        'foto_evento' => 'required|image|mimes:png,jpg,jpeg|max:2048',
    ];

    protected $messages = [
        'titulo.required' => 'Debe ingresar un título',
        'titulo.min' => 'El largo mínimo es de 3 caracteres',

        'descripcion.required' => 'Debe ingresar una descripción',
        'descripcion.min' => 'El largo mínimo es de 10 caracteres',

        'fecha_inicio.required' => 'Debe ingresar la fecha de inicio del evento',

        'fecha_termino.required' => 'Debe ingresar la fecha de termino del evento',

        'lugar.required' => 'Debe ingresar el lugar del evento',
        'lugar.min' => 'El largo mínimo es de 3 caracteres',

        'foto_portada.required' => 'Debe ingresar una foto de Portada',
        'foto_portada.image' => 'Debe ingresar una imagen',
        'foto_portada.mimes' => 'Debe ingresar una imagen tipo jpg, png o jpeg',
        'foto_portada.max' => 'El tamaño máximpo admitido es de 2mb',

        'foto_evento.required' => 'Debe ingresar una foto del Evento',
        'foto_evento.image' => 'Debe ingresar una imagen',
        'foto_evento.mimes' => 'Debe ingresar una imagen tipo jpg, png o jpeg',
        'foto_evento.max' => 'El tamaño máximpo admitido es de 2mb',
    ];

    public function updated($nombrePropiedad)
    {
        $this->validateOnly($nombrePropiedad);
    }

    public function guardar() {
        $data = $this->validate();
        app('App\Http\Controllers\EventoController')->guardar($data);
    }
}
