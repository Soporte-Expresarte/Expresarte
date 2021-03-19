<?php

namespace App\Http\Livewire\Galeria;

use App\Models\Evento;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormEditEvento extends Component
{
    use WithFileUploads;

    public $evento;
    public $titulo;
    public $descripcion;
    public $fecha_inicio;
    public $fecha_termino;
    public $lugar;
    public $foto_portada;
    public $foto_evento;

    public function mount(){
        $this->titulo = $this->evento->titulo;
        $this->descripcion = $this->evento->descripcion;
        $this->fecha_inicio = Carbon::parse($this->evento->fecha_evento)->format('Y-m-d\TH:i');
        $this->fecha_termino = Carbon::parse($this->evento->fecha_evento)->addMinute($this->evento->duracion)->format('Y-m-d\TH:i');
        $this->lugar = $this->evento->lugar;
        $this->foto_portada_antigua = $this->evento->foto_portada;
        $this->foto_evento_antigua = $this->evento->foto_evento;
    }

    public function render()
    {
        return view('livewire.galeria.form-edit-evento');
    }

    public $rules = [
        'titulo' => 'required|min:3',
        'descripcion' => 'required|min:10',
        'fecha_inicio' =>  'required',
        'fecha_termino' =>  'required',
        'lugar' => 'required|min:3',
        'foto_portada' => '',
        'foto_evento' => '',
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

    ];

    public function updated($nombrePropiedad)
    {
        $this->validateOnly($nombrePropiedad);
    }

    public function actualizar() {

        $data = $this->validate();
        $bool_evento = false;
        $bool_portada = false;
        if ($data['foto_evento'] != null){
            $bool_evento = true;
            $this->validate(
                ['foto_evento' => 'required|image|mimes:png,jpg,jpeg|max:2048'],
                ['foto_evento.required' => 'Debe ingresar una foto del Evento',
                 'foto_evento.image' => 'Debe ingresar una imagen',
                 'foto_evento.mimes' => 'Debe ingresar una imagen tipo jpg, png o jpeg',
                 'foto_evento.max' => 'El tamaño máximpo admitido es de 2mb']
            );
        }

        if ($data['foto_portada'] != null){
            $bool_portada = true;
            $this->validate(
                ['foto_portada' => 'required|image|mimes:png,jpg,jpeg|max:2048'],
                ['foto_portada.required' => 'Debe ingresar una foto del Evento',
                 'foto_portada.image' => 'Debe ingresar una imagen',
                 'foto_portada.mimes' => 'Debe ingresar una imagen tipo jpg, png o jpeg',
                 'foto_portada.max' => 'El tamaño máximpo admitido es de 2mb']
            );
        }

        app('App\Http\Controllers\EventoController')->actualizar($data, $this->evento);
    }
}
