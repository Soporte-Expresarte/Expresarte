<?php

namespace App\Http\Livewire\Market;

use App\Models\ImagenProyecto;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\ImagenProducto;
use App\Models\Tema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormularioEdicionProducto extends Component
{

    use WithFileUploads;

    public $producto;
    public $idProducto;
    public $nombre = "";
    public $descripcion = "";
    public $categoria_id = "";
    public $tema_id = "";
    public $largo;
    public $ancho;
    public $alto;
    public $precio;
    public $stock;

    // Array de imágenes que están siendo seleccionadas para ser eliminadas.
    public $imagenesParaBorrar = [];

    // Collection de imágenes ya registradas en el sistema.
    public $imagenesAntiguas;

    // Nuevas imágenes que serán agregadas durante la edición.
    public $imagenes = [];

    public $rules = [];

    /**
     * Listeners de los componentes.
     *
     * @var array
     */
    protected $listeners = [
        'refrescar-imagenes-antiguas' => '$refresh',
    ];

    public function mount($slug)
    {
        $this->producto = Producto::where('slug', $slug)->first();

        $this->idProducto = $this->producto->id;
        $this->nombre = $this->producto->nombre;
        $this->descripcion = $this->producto->descripcion;
        $this->categoria_id = $this->producto->categoria_id;
        $this->tema_id = $this->producto->tema_id;

        $this->largo = $this->producto->largo;
        $this->ancho = $this->producto->ancho;
        $this->alto = $this->producto->alto;

        $this->precio = $this->producto->precio;
        $this->stock = $this->producto->stock;
        $this->imagenesAntiguas = $this->producto->imagenes;

        // Es necesario definirlo aquí ya que $this->id se obtiene en tiempo de ejecución, no en compilación.
        $this->rules = [
            'nombre' => 'required|min:3|max:255|unique:productos,nombre,' . $this->idProducto,
            'descripcion' => 'required|min:5',
            'categoria_id' => 'required',
            'tema_id' => 'required',

            'largo' => 'required|numeric|gt:0',
            'ancho' => 'required|numeric|gt:0',
            'alto' => 'nullable|numeric|gt:0',

            'precio' => 'required|integer|gt:0',
            'stock' => 'required|integer|gt:0',

            'imagenes.*' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }

    public function render()
    {
        return view('livewire.market.formulario-edicion-producto', [
            'categorias' => Categoria::all(),
            'temas' => Tema::all(),
        ]);
    }

    protected $messages = [
        // Nombre
        'nombre.required' => 'Debes ingresar un nombre.',
        'nombre.min' => 'El nombre debe contener como mínimo 3 caracteres.',
        'nombre.unique' => 'Este nombre ya se encuentra en uso.',

        // Descripción
        'descripcion.required' => 'Debes ingresar una descripción.',
        'descripcion.min' => 'La descripción debe contener como mínimo 40 caracteres.',

        // Categoría
        'categoria_id.required' => 'Debes seleccionar una categoría.',

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

        'imagenes.*.required' => 'Debe subir imágenes para su producto.',
        'imagenes.*.image' => 'Debe subir archivos válidos.',
        'imagenes.*.mimes' => 'Debe subir imágenes jpg, png o jpeg.',
        'imagenes.*.max' => 'El tamaño admitido es máximo 2mb.',
    ];

    public function updated($nombrePropiedad)
    {
        $this->validateOnly($nombrePropiedad);
    }

    public function submit()
    {
        $info_validada = $this->validate();

        // Asigna el slug del producto para URL's amigables.
        $info_validada['slug'] = Str::slug($this->nombre);

        $this->borrarImagenes();

        // Actualiza el producto.
        app('App\Http\Controllers\ProductoController')->actualizar($info_validada, $this->producto);
    }

    public function cancel()
    {
        session()->flash('success', 'Actualizacion del Producto cancelada.');
        return redirect()->route('vista-perfil');
    }

    public function agregarImagenParaBorrar(ImagenProducto $imagen)
    {

        // Primero se busca si la imagen ya se ha guardado para ser borrada.
        $indiceImagen = -1;
        foreach ($this->imagenesParaBorrar as $indice => $img) {
            // Se accede a las propiedades de $imagen con ->id ya que es un objeto de tipo ImagenProducto proveniente de la BD.
            // $img es un objeto guardado en un array, por lo que se accede a sus propiedades con ['id'].
            if ($img['id'] == $imagen->id) {
                $indiceImagen = $indice;
                break;
            }
        }

        if ($indiceImagen != -1) array_splice($this->imagenesParaBorrar, $indiceImagen, 1);
        else array_push($this->imagenesParaBorrar, $imagen);

        // Actualiza las imágenes dependiendo de cuáles serán borradas.
        $this->emit("marcarImagenes", $this->imagenesParaBorrar);
    }

    public function borrarImagenes()
    {
        if (sizeof($this->imagenes) > 0)
            foreach ($this->producto->imagenes as $img)
                ImagenProducto::destroy($img->id);

        foreach ($this->imagenesParaBorrar as $imagen) {

            // Se obtiene la ruta en un arreglo de Strings.
            $splitter = explode("storage/", $imagen['ruta']);
            // La ruta está en la 2da posición del arreglo.
            $nombre = $splitter[1];
            // Se elimina la imagen del directorio.
            Storage::delete("public/" . $nombre);

            // Elimina la imagen de la BD.
            ImagenProducto::destroy($imagen['id']);
        }
    }
}
