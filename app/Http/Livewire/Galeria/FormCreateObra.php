<?php

namespace App\Http\Livewire\Galeria;

use App\Http\Controllers\ObraController;
use App\Http\Controllers\ProductoController;
use App\Models\Obra;
use App\Models\TipoObra;
use App\Models\User;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use function PHPUnit\Framework\throwException;

class FormCreateObra extends Component
{

    use WithFileUploads;

    public $titulo;
    public $descripcion;
    public $tipo;
    public $especificaciones;
    public $imagenes = [];

    public $usuario_id;
    public $tipo_obra_id;
    public $editMode = false;


    public function render()
    {
        return view('livewire.galeria.form-create-obra', [
            'tipos' => TipoObra::all()
        ]);
    }

    public $rules = [
        'titulo' => 'required|min:3',
        'descripcion' => 'required|min:10',
        'tipo' => 'required',
        'especificaciones' => 'required|min:10',
        'imagenes' => 'max:2048',
    ];

    protected $messages = [
        'titulo.required' => 'Debe ingresar un Título.',
        'titulo.min' => 'El Título debe ser de al menos 3 caracteres.',

        'descripcion.required' => 'Debe ingresar una Descripción.',
        'descripcion.min' => 'La Descripción debe ser de al menos 10 caracteres.',

        'tipo.required' => 'Debe ingresar una Tipo.',

        'especificaciones.required' => 'Debe ingresar un Especificaciones.',
        'especificaciones.min' => 'Las Especificaciones deben ser de al menos 10 caracteres.',

        'imagenes.required' => 'Debe ingresar al menos una Imagen.',
        'imagenes.image' => 'Debe subir una Imagen, no se permiten otros archivos.',
        'imagenes.mimes' => 'Solo se admiten imágenes en formato jpg, png o jpeg.',
        'imagenes.max' => 'El tamaño maximo de las imagenes subidas no puede superar los 2mb.',
    ];

    public function edit(Obra $obra)
    {
        $elTipo = TipoObra::find($obra->tipo_obra_id);

        $this->titulo = $obra->titulo;
        $this->descripcion = $obra->descripcion;
        $this->tipo = $elTipo->nombre;
        $this->especificaciones = $obra->especificaciones;
        $this->imagenes = $obra->imagenes();
        $this->usuario_id = $obra->usuario_id;
        $this->tipo_obra_id = $obra->tipo_obra_id;

        $this->editMode = true;
    }

    public function updated($propertyName)
    {
        $this->editMode = false;
        $this->validateOnly($propertyName);
    }

    public function cancel()
    {
        $this->editMode = false;
        return redirect()->to(route('index-exposiciones'));
    }

    public function store()
    {
        $this->editMode = false;
        $validatedData = $this->validate();

        //session()->flash('message', 'Post Created Successfully.');
        app('App\Http\Controllers\ObraController')->store($validatedData, $this->imagenes);
    }

}
