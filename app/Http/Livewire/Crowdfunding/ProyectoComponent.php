<?php

namespace App\Http\Livewire\Crowdfunding;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\ImagenProyecto;
use App\Models\Premio;
use Auth;

class ProyectoComponent extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $titulo = '';
    public $sub_titulo = '';
    public $descripcion = '';
    public $estado = '';
    public $imagen_portada;
    public $url_video;
    public $imagenes = [];
    //public $fechaInicio   = '';
    //public $fecha_limite    = '';
    public $duracion_dias = '';
    public $monto_actual = '';
    public $meta = '';
    public $usuario_id = '';

    public $listener = ['agregarProyecto' => 'submit'];
    //public $listener = ['agregarProyecto'];

    //premios
    public $premios = [];


    public $rules = [
        'titulo' => 'required|min:3|max:80',
        'sub_titulo' => 'required|min:3|max:100',
        'descripcion' => 'required|min:10|max:2000',
        'imagen_portada' => 'required|image|mimes:jpeg,png,jpg|max:8096',
        'duracion_dias' => 'required|numeric|min:14|max:120',
        'meta' => 'required|numeric|min:50000|max:2000000000',
        'url_video' => ['required', 'url', 'regex:/(youtube)|(youtu.be)/'],
        'imagenes' => 'array|between:1,10',

        'premios' => 'array|between:0,10',
        'premios.*.nombre' => 'required|distinct|min:3|max:50',
        'premios.*.descripcion' => 'required|min:5|max:1000',
        'premios.*.precio_minimo' => 'required|numeric|min:1000|max:10000000',
        'premios.*.cantidad_maxima' => 'required|numeric|min:1|max:10000000',
    ];

    public $messages = [

        // Titulo
        'titulo.required' => 'Este campo debe ser especificado !',
        'titulo.min' => 'El texto ingresado debe contener mas de 3 caracteres !',
        'titulo.max' => 'El texto ingresado debe contener menos de 80 caracteres !',

        // Subtitulo
        'sub_titulo.required' => 'Este campo debe ser especificado !',
        'sub_titulo.min' => 'El texto ingresado debe contener más de 3 caracteres !',
        'sub_titulo.max' => 'El texto ingresado debe contener menos de 100 caracteres !',


        // Descripcion
        'descripcion.required' => 'Este campo debe ser especificado !',
        'descripcion.min' => 'La descripción debe contener mas de 10 caracteres !',
        'descripcion.max' => 'La descripción debe contener menos de 2000 caracteres !',

        // Cantidad Dias
        'duracion_dias.required' => 'Este campo debe ser especificado !',
        'duracion_dias.numeric' => 'El campo debe ser un número !',
        'duracion_dias.min' => 'La duración del proyecto debe ser igual o mayor a 14 días !',
        'duracion_dias.max' => 'La duración del proyecto debe ser de máximo a 120 días !',

        // Imagen
        'imagen_portada.required' => 'Este campo debe ser especificado !',
        'imagen_portada.image' => 'El archivo debe ser una imagen !',
        'imagen_portada.mimes' => 'El formato del archivo debe ser jpeg, jpg o png !',
        'imagen_portada.max' => 'El tamaño de la imagen debe ser menor a 8 MB !',

        // Meta
        'meta.required' => 'Este campo debe ser especificado !',
        'meta.numeric' => 'Este campo debe ser llenado con un número !',
        'meta.min' => 'El valor ingresado debe ser igual o mayor a 50.000 CLP!',
        'meta.max' => 'El valor ingresado debe ser menor a 2.000.000.000 CLP!',

        //URL
        'url_video.required' => 'Este campo debe ser especificado !',
        'url_video.url' => 'Debe ingresar un formato válido de URL !',
        'url_video.regex' => 'Ingrese solo enlaces de youtube !',

        //imagenes
        'imagenes.between' => 'Debe haber entre 1 y 10 imagenes adicionales',

        //premio
        'premios.between' => 'Debe haber entre 0 y 10 premios',

        //Premio_nombre
        'premios.*.nombre.required' => 'Este campo debe ser especificado !',
        'premios.*.nombre.distinct' => 'Este nombre ya ha sido utilizado !',
        'premios.*.nombre.min' => 'Este campo debe ser mayor a 3 !',
        'premios.*.nombre.max' => 'Este campo debe ser menor a 50 !',

        //Premio_descripcion
        'premios.*.descripcion.required' => 'Este campo debe ser especificado !',
        'premios.*.descripcion.min' => 'Este campo debe ser mayor a 5 !',
        'premios.*.descripcion.max' => 'Este campo debe ser menor a 1000 !',

        //Premio_precio_minimo
        'premios.*.precio_minimo.required' => 'Este campo debe ser especificado !',
        'premios.*.precio_minimo.numeric' => 'Este campo debe ser llenado con un número !',
        'premios.*.precio_minimo.min' => 'Este campo debe ser mayor a 1.000 CLP !',
        'premios.*.precio_minimo.max' => 'Este campo debe ser menor a 10.000.000 CLP !',

        //Premio_cantidad_maxima
        'premios.*.cantidad_maxima.numeric' => 'Este campo debe ser llenado con un número !',
        'premios.*.cantidad_maxima.min' => 'Este campo debe ser igual o mayor a 1 !',
        'premios.*.cantidad_maxima.max' => 'Este campo debe ser menor a 10.000.000 unidades !',
        'premios.*.cantidad_maxima.required' => 'Este campo debe ser especificado !',

    ];

    public function mount()
    {
        //$this->agregarPremio();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.crowdfunding.proyecto-component');
    }

    public function agregarPremio()
    {
        $this->premios[] = [];
    }

    public function eliminarPremio($index)
    {
        unset($this->premios[$index]);
        $this->premios = array_values($this->premios);
    }

    public function submit()
    {

        $infoValidada = $this->validate();
        $infoValidada['usuario_id'] = Auth::user()->id;

        // imagen de portada
        $rutaImagen = Storage::disk('public')->put('crowdfunding', $this->imagen_portada);
        $infoValidada['imagen_portada'] = 'storage/' . $rutaImagen;

        app('App\Http\Controllers\ProyectoController')->store($infoValidada, $this->imagenes, $this->premios);

    }

}
