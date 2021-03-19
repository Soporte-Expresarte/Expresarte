<?php

namespace App\Http\Livewire\Crowdfunding;

use App\Models\ImagenProyecto;
use App\Models\Premio;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\UnauthorizedException;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProyecto extends Component
{
    use WithFileUploads;

    public $el_proyecto;
    public $id_proyecto;

    public $titulo;
    public $sub_titulo;
    public $descripcion;

    public $url_video;

    public $premios = [];
    public $nuevos_premios = [];

    // imagenes actuales
    public $imagen_portada_actual;
    public $demas_imagenes_actuales;

    // imagenes nuevas
    public $imagen_portada;
    public $imagenes = [];

    public $rules = [
        'titulo' => 'required|min:3|max:80',
        'sub_titulo' => 'required|min:3|max:200',
        'descripcion' => 'required|min:10|max:2000',
        'url_video' => ['required', 'url', 'regex:/(youtube)|(youtu.be)/'],

        'nuevos_premios' => 'array|between:0,10',
        'nuevos_premios.*.nombre' => 'required|distinct|min:3|max:50',
        'nuevos_premios.*.descripcion' => 'required|min:5|max:1000',
        'nuevos_premios.*.precio_minimo' => 'required|numeric|min:1000|max:10000000',
        'nuevos_premios.*.cantidad_maxima' => 'required|numeric|min:1|max:10000000',
    ];

    public $messages = [

        // Titulo
        'titulo.required' => 'Este campo debe ser especificado !',
        'titulo.min' => 'El texto ingresado debe contener mas de 3 caracteres !',
        'titulo.max' => 'El texto ingresado debe contener menos de 80 caracteres !',

        // Subtitulo
        'sub_titulo.required' => 'Este campo debe ser especificado !',
        'sub_titulo.min' => 'El texto ingresado debe contener más de 3 caracteres !',
        'sub_titulo.max' => 'El texto ingresado debe contener menos de 200 caracteres !',

        // Descripcion
        'descripcion.required' => 'Este campo debe ser especificado !',
        'descripcion.min' => 'La descripción debe contener mas de 10 caracteres !',
        'descripcion.max' => 'La descripción debe contener menos de 2000 caracteres !',


        // Imagen
        'imagen_portada.required' => 'Este campo debe ser especificado !',
        'imagen_portada.image' => 'El archivo debe ser una imagen !',
        'imagen_portada.mimes' => 'El formato del archivo debe ser jpeg, jpg o png !',
        'imagen_portada.max' => 'El tamaño de la imagen debe ser menor a 2mb.',

        //URL
        'url_video.required' => 'Este campo debe ser especificado !',
        'url_video.url' => 'Debe ingresar un formato válido de URL !',
        'url_video.regex' => 'Ingrese solo enlaces de youtube !',

        //imagenes
        'imagenes.between' => 'Debe haber entre 1 y 10 imagenes adicionales',

        //premio
        'nuevos_premios.between' => 'Debe haber entre 0 y 10 premios',
        //Premio_nombre
        'nuevos_premios.*.nombre.required' => 'Este campo debe ser especificado !',
        'nuevos_premios.*.nombre.distinct' => 'Este nombre ya ha sido utilizado !',
        'nuevos_premios.*.nombre.min' => 'Este campo debe ser mayor a 3 !',
        'nuevos_premios.*.nombre.max' => 'Este campo debe ser menor a 50 !',

        //Premio_descripcion
        'nuevos_premios.*.descripcion.required' => 'Este campo debe ser especificado !',
        'nuevos_premios.*.descripcion.min' => 'Este campo debe ser mayor a 5 !',
        'nuevos_premios.*.descripcion.max' => 'Este campo debe ser menor a 1000 !',

        //Premio_precio_minimo
        'nuevos_premios.*.precio_minimo.required' => 'Este campo debe ser especificado !',
        'nuevos_premios.*.precio_minimo.numeric' => 'Este campo debe ser llenado con un número !',
        'nuevos_premios.*.precio_minimo.min' => 'Este campo debe ser mayor a 1.000 CLP !',
        'nuevos_premios.*.precio_minimo.max' => 'Este campo debe ser menor a 10.000.000 CLP !',

        //Premio_cantidad_maxima
        'nuevos_premios.*.cantidad_maxima.numeric' => 'Este campo debe ser llenado con un número !',
        'nuevos_premios.*.cantidad_maxima.min' => 'Este campo debe ser igual o mayor a 1 !',
        'nuevos_premios.*.cantidad_maxima.max' => 'Este campo debe ser menor a 10.000.000 unidades !',
        'nuevos_premios.*.cantidad_maxima.required' => 'Este campo debe ser especificado !',
    ];

    public function mount($id)
    {
        $this->el_proyecto = Proyecto::find($id);
        $this->id_proyecto = $id;
        $this->titulo = $this->el_proyecto->titulo;
        $this->sub_titulo = $this->el_proyecto->sub_titulo;
        $this->descripcion = $this->el_proyecto->descripcion;
        $this->meta = $this->el_proyecto->meta;
        $this->duracion_dias = $this->el_proyecto->duracion_dias;
        $this->url_video = $this->el_proyecto->url_video;
        $this->premios = $this->el_proyecto->premios;
        $this->imagen_portada_actual = $this->el_proyecto->imagen_portada;
        $this->demas_imagenes_actuales = $this->el_proyecto->imagenes;
        $this->premios = $this->el_proyecto->premios;
    }

    public function render()
    {
        return view('livewire.crowdfunding.edit-proyecto');
    }

    public function submit()
    {
        $validaciones = $this->validate();

        // en caso de haber imagen de portada
        if ($this->imagen_portada) {
            // se borra la portada anterior y se agrega la nueva
            Storage::delete($this->el_proyecto->imagen_portada);
            $this->el_proyecto->imagen_portada = 'storage/' . Storage::disk('public')->put('crowdfunding', $this->imagen_portada);
        }

        // en caso de haber imagenes nuevas
        if ($this->imagenes) {
            // borrar imagenes anteriores
            foreach ($this->el_proyecto->imagenes as $img)
                ImagenProyecto::destroy($img->id);

            // agregar las imagenes nuevas
            foreach ($this->imagenes as $img)
                ImagenProyecto::create([
                    'ruta' => 'storage/' . Storage::disk('public')->put('crowdfunding', $img),
                    'proyecto_id' => $this->id_proyecto
                ]);
        }

        // actualizaciones de los datos nuevos del proyecto
        $this->el_proyecto->titulo = $this->titulo;
        $this->el_proyecto->sub_titulo = $this->sub_titulo;
        $this->el_proyecto->descripcion = $this->descripcion;
        $this->el_proyecto->save();

        //se cambia la url del video a un embed
        if ($this->url_video) {
            $url = $this->url_video;

            // se elimina el contenido desde el primer '&'
            $i = stripos($url, "&");
            if ($i !== false)
                $url = substr($url, 0, $i);

            // se cambia watch?v= por embed/
            $this->el_proyecto->update(['url_video' => preg_replace("/watch\?v\=/", "embed/", $url)]);
        }

        // agregar nuevos premios
        if (sizeof($this->nuevos_premios) > 0)
            foreach ($this->nuevos_premios as $prem)
                Premio::create([
                    'nombre' => $prem['nombre'],
                    'descripcion' => $prem['descripcion'],
                    'precio_minimo' => $prem['precio_minimo'],
                    'cantidad_actual' => $prem['cantidad_maxima'],
                    'cantidad_maxima' => $prem['cantidad_maxima'],
                    'proyecto_id' => $this->id_proyecto,
                ]);

        session()->flash('success', 'Proyecto editado satisfactoriamente.');
        return redirect()->route('mostrar-proyecto', $this->id_proyecto);
    }

    public function agregarPremio()
    {
        $this->nuevos_premios[] = [];
    }

    public function eliminarPremio($index)
    {
        unset($this->nuevos_premios[$index]);
        $this->nuevos_premios = array_values($this->nuevos_premios);
    }

    public function cancel()
    {
        session()->flash('success', 'Actualizacion del Proyecto cancelada.');
        return redirect()->route('vista-perfil');
    }
}
