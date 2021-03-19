<?php

namespace App\Http\Livewire\Perfil\Galeria\Artista;

use App\Http\Controllers\PerfilController;
use App\Models\Perfil;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarDatos extends Component
{
    use WithFileUploads;

    public $perfil;
    public $idUser;
    public $userActual;
    public $perfilActual;
    public $descripcion;
    public $cita;
    public $facebook;
    public $instagram;
    public $twitter;
    public $fotoPortada;
    public $fotoArtista;
    public $fotoPortadaActual;
    public $fotoArtistaActual;

    public $rules = [];

    public function render()
    {
        return view('livewire.perfil.galeria.artista.editar-datos');
    }

    public function mount()
    {
        $this->userActual   = User::where('id', $this->idUser)->first();
        $this->perfilActual = Perfil::where('id', $this->userActual->perfil_id)
                                    ->first();

        $this->rules = [
            'cita'        => 'required|min:3',
            'descripcion' => 'required|min:3',
            'facebook'    => 'nullable|min:3',
            'instagram'   => 'nullable|min:3',
            'twitter'     => 'nullable|min:3'
        ];

        if ($this->userActual->perfil_id != null) {
            $this->descripcion = $this->perfilActual->descripcion;
            $this->cita        = $this->perfilActual->cita;
            $this->facebook    = $this->perfilActual->facebook;
            $this->instagram   = $this->perfilActual->instagram;
            $this->twitter     = $this->perfilActual->twitter;
            $this->fotoArtista = $this->perfilActual->foto_artista;
            $this->fotoPortada = $this->perfilActual->foto_portada;
            $this->fotoArtistaActual = $this->perfilActual->foto_artista;
            $this->fotoPortadaActual = $this->perfilActual->foto_portada;
        }
    }

    protected $messages = [
        'descripcion.required' => 'Debes ingresar una descripción',
        'descripcion.min' => 'La descripcion debe contener como mínimo 3 carácteres',

        'cita.required' => 'Debes ingresar una cita',
        'cita.min' => 'La cita de contener como mínimo 3 carácteres',

        'facebook.min' => 'El facebook debe contener como mínimo 3 carácteres',
        'instagram.min' => 'El instagram debe contener como mínimo 3 carácteres',
        'twitter.min' => 'El twitter debe contener como mínimo 3 carácteres',

        'fotoArtista.image'                    => 'Debe subir archivos válidos.',
        'fotoArtista.mimes'                    => 'Debe subir imágenes jpg, png o jpeg.',
        'fotoArtista.max'                    => 'El tamaño admitido es máximo 2mb.',

        'fotoPortada.image'                    => 'Debe subir archivos válidos.',
        'fotoPortada.mimes'                    => 'Debe subir imágenes jpg, png o jpeg.',
        'fotoPortada.max'                    => 'El tamaño admitido es máximo 2mb.',
    ];

    public function updated($nombrePropiedad)
    {
        $this->validateOnly($nombrePropiedad);
    }

    public function accion() {

        if($this->userActual->perfil_id != null){
            $this->edit();
        }else{
            $this->creacion();
        }
    }

    public function creacion() {
        $validatedData = $this->validate();
        app('App\Http\Controllers\PerfilController')->create($validatedData, $this->fotoArtista, $this->fotoPortada, $this->userActual);
    }

    public function edit() {

        $validatedData = $this->validate();
        if (is_string($this->fotoArtista)){ //No se cambia
            $this->fotoArtista = [];
        }

        if (is_string($this->fotoPortada)){ //No se cambia
            $this->fotoPortada = [];
        }

        app('App\Http\Controllers\PerfilController')->edit($validatedData, $this->perfilActual, $this->fotoArtista, $this->fotoPortada, $this->fotoArtistaActual, $this->fotoPortadaActual);
    }
}
