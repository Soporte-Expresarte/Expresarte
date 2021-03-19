<?php

namespace App\Http\Livewire\Galeria;

use App\Models\Evento;
use App\Models\ImagenObra;
use App\Models\Obra;
use App\Models\Tag;
use App\Models\TipoObra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use function PHPUnit\Framework\throwException;

class AdminObras extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $id_obra;
    public $titulo;
    public $descripcion;
    public $tipo;
    public $especificaciones;
    public $imagenes;
    public $usuario_id;
    public $tipo_obra_id;

    public $nuevas_imagenes = [];
    public $obras;

    public $action;

    public $rules = [
        'titulo' => 'required|min:3',
        'descripcion' => 'required|min:10',
        'tipo' => 'required',
        'especificaciones' => 'required|min:10',
        //'imagenes' => 'required|image|mimes:png,jpg,jpeg|max:8192',
        'nuevas_imagenes' => 'required',
        'nuevas_imagenes.*' => 'image|mimes:png,jpg,jpeg|max:2048'
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

        'nuevas_imagenes.required' => 'Debe ingresar al menos una Imagen.',
        'nuevas_imagenes.image' => 'Debe subir una Imagen, no se permiten otros archivos.',
        'nuevas_imagenes.mimes' => 'Solo se admiten imágenes en formato jpg, png o jpeg.',
        'nuevas_imagenes.max' => 'El tamaño maximo de las imagenes subidas no puede superar los 2mb.',
    ];


    public function mount($action)
    {
        $this->action = $action;
    }

    public function render()
    {
        if ($this->action == 'create')
            return view('livewire.galeria.form-create-obra');

        if ($this->action == 'edit')
            return view('livewire.galeria.form-edit-obra');

        if ($this->action == 'admin')
            return view('livewire.galeria.admin-obras', [
                'todas_obras' => Obra::orderBy('created_at', 'desc')->where('estado', '=', 'APROBADO')->where('usuario_id', '=', Auth::id())->get()
            ]);

        return redirect('/galeria/exposiciones');
    }

    public function edit(Obra $obra)
    {
        $this->action = 'edit';
        $elTipo = TipoObra::find($obra->tipo_obra_id);

        $this->id_obra = $obra->id;
        $this->titulo = $obra->titulo;
        $this->descripcion = $obra->descripcion;
        $this->tipo = $elTipo->nombre;
        $this->especificaciones = $obra->especificaciones;
        $this->imagenes = $obra->imagenes;
        $this->usuario_id = $obra->usuario_id;
        $this->tipo_obra_id = $obra->tipo_obra_id;
    }

    public function update()
    {
        $obra_update = Obra::find($this->id_obra);

        if ($this->nuevas_imagenes) {
            // validacion de las imagenes nuevas
            $this->validate([
                'nuevas_imagenes.*' => 'image|mimes:png,jpg,jpeg|max:2048',
            ], $this->messages);

            // borrar todas las imagenes relacionadas a una obra
            Storage::delete($this->imagenes);
            foreach (Obra::find($this->id_obra)->imagenes as $imagen_indi)
                $imagen_indi->delete();

            // las imagenes actuales seran nuevo array
            $this->imagenes = array();

            // asignacion de las nuevas imagenes para la obra
            foreach ($this->nuevas_imagenes as $imagen) {
                $salvar = 'storage/' .
                    (Storage::disk('public')
                        ->put('imagenes-galeria/noticias', $imagen));

                $nueva_imagen = ImagenObra::create([
                    'ruta' => $salvar,
                    'obra_id' => $this->id_obra
                ]);

                array_push($this->imagenes, $nueva_imagen);
            }

            $this->reset(['nuevas_imagenes']);
        }

        $this->validate([
            'titulo' => 'required|min:3',
            'descripcion' => 'required|min:10',
            'tipo' => 'required',
            'especificaciones' => 'required|min:10',
        ], $this->messages);

        $obra_update->update([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'tipo' => $this->tipo,
            'tipo_obra_id' => $this->tipo_obra_id,
            'especificaciones' => $this->especificaciones,
            'usuario_id' => Auth::user()->id
        ]);

        session()->flash('success', 'Noticia actualizada correctamente!');
        return redirect()->route('admin-obras');
    }

    public function cancel()
    {
        $this->action = 'admin';

        $this->reset([
            'titulo',
            'descripcion',
            'tipo',
            'especificaciones',
            'imagenes'
        ]);

        return redirect()->route('admin-obras');
    }

    public function destroy(Obra $obra)
    {
        $obra->delete();
        session()->flash('success', 'Obra eliminada exitosamente');
        return redirect()->route('admin-obras');
        //app('App\Http\Controllers\ObraController')->destroy($obra);
    }

    public function store()
    {
        $validatedData = $this->validate();
        app('App\Http\Controllers\ObraController')->store($validatedData, $this->nuevas_imagenes);
    }
}
