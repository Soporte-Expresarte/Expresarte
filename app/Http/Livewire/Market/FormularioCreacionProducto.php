<?php

namespace App\Http\Livewire\Market;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Tema;
use Illuminate\Support\Str;

class FormularioCreacionProducto extends Component
{

    use WithFileUploads;

    public $nombre;
    public $descripcion;
    public $categoria_id;
    public $tema_id;

    public $largo;
    public $ancho;
    public $alto;

    public $precio;
    public $stock;
    public $imagenes = array();

    public function render()
    {
        return view('livewire.market.formulario-creacion-producto', [
            'categorias' => Categoria::all()->sortBy('nombre'),
            'temas' => Tema::all()->sortBy('nombre'),
        ]);
    }

    public $rules = [
        'nombre' => 'required|min:3|unique:productos,nombre',
        'descripcion' => 'required|min:10',
        'categoria_id' => 'required',
        'tema_id' => 'required',

        'largo' => 'required|numeric|gt:0',
        'ancho' => 'required|numeric|gt:0',
        'alto' => 'nullable|numeric|gt:0',

        'precio' => 'required|integer|gt:0',
        'stock' => 'required|integer|gt:0',

        'imagenes' => 'required',
        'imagenes.*' => 'image|mimes:png,jpg,jpeg|max:2048'
    ];

    protected $messages = [
        // Nombre
        'nombre.required' => 'Debe ingresar un nombre.',
        'nombre.min' => 'El nombre debe contener como mínimo 3 caracteres.',
        'nombre.unique' => 'Este nombre ya se encuentra en uso.',

        // Descripción
        'descripcion.required' => 'Debe ingresar una descripción.',
        'descripcion.min' => 'La descripción debe contener como mínimo 10 caracteres.',

        // Categoría
        'categoria_id.required' => 'Debe seleccionar una categoría.',

        // Tema
        'tema_id.required' => 'Debe seleccionar un tema.',

        // Largo, ancho y alto
        'largo.required' => 'Debe ingresar un largo.',
        'largo.numeric' => 'Debe ingresar un largo válido.',
        'largo.gt' => 'El largo debe ser mayor a 0.',
        'ancho.required' => 'Debe ingresar un ancho.',
        'ancho.numeric' => 'Debe ingresar un ancho válido.',
        'ancho.gt' => 'El ancho debe ser mayor a 0.',
        'alto.numeric' => 'Debe ingresar un alto válido.',
        'alto.gt' => 'El alto debe ser mayor a 0.',

        // Precio
        'precio.required' => 'Debe ingresar un precio para el producto.',
        'precio.integer' => 'Ingrese un número válido.',
        'precio.gt' => 'El precio debe ser mayor a 0.',

        // Stock
        'stock.required' => 'Debe ingresar un stock inicial para su producto.',
        'stock.integer' => 'El stock debe ser un número.',
        'stock.gt' => 'El stock debe ser mayor a 0.',

        'imagenes.required' => 'Debe subir imágenes para su producto.',
        'imagenes.*.image' => 'Debe subir archivos válidos.',
        'imagenes.*.mimes' => 'Debe subir imágenes jpg, png o jpeg.',
        'imagenes.*.max' => 'El tamaño admitido es máximo 2mb.',
    ];

    /**
     * Actualiza un campo en tiempo real.
     */
    public function updated($nombrePropiedad)
    {
        $this->validateOnly($nombrePropiedad);
    }

    public function submit()
    {
        $info_validada = $this->validate();

        // Define que el numero de productos vendidos hasta ahora es 0.
        $info_validada['vendidos'] = 0;
        $info_validada['usuario_id'] = Auth::id();


        // Asigna el slug del producto para URL's amigables.
        $info_validada['slug'] = Str::slug($this->nombre);

        // Registra el producto en el sistema.
        app('App\Http\Controllers\ProductoController')->registrar($info_validada);

    }
}
