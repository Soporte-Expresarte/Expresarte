<?php

namespace App\Http\Livewire\Market;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Tema;

class GridProductos extends Component
{
    protected $queryString = [
        'tema' => ['except' => ""],
        'busqueda_nombre_artista' => ['except' => ''],
        'busqueda_nombre_producto' => ['except' => ''],
        'por_pagina',
    ];

    use WithPagination;

    public $categoria_id = "";
    public $categoria = "";
    public $categoria_nombre = "";

    public $busqueda = "";
    public $busqueda_nombre_artista_antigua = "";
    public $busqueda_nombre_artista = "";
    public $busqueda_nombre_producto_antigua = "";
    public $busqueda_nombre_producto = "";

    public $por_pagina = "9";

    public $tema_id_antigua = "";
    public $tema_id = "";
    // $tema es el slug para poder mostrarse bien en la url.
    public $tema = "";
    public $tema_nombre = "";

    public $ordenamiento_antiguo;
    public $ordenamiento;

    public function mount($slug, $busqueda)
    {
        if ($slug != "") {
            $categoria = Categoria::where('slug', $slug)->first();
            $this->categoria_id = $categoria->id;
            $this->categoria_nombre = $categoria->nombre;
        }
        if ($busqueda != "") {
            $this->busqueda = $busqueda;
        }
    }

    public function render()
    {
        $productos = Producto::select('productos.*','users.name')
        ->join('users','productos.usuario_id','=','users.id')
        ->where('en_venta', 1)
        ->where('productos.stock','>',0);

        if ($this->categoria_id != "") {
            $productos->where('productos.categoria_id', $this->categoria_id);
        }

        if ($this->busqueda != "") {
            $productos->where(function ($query) {
                $query->where('productos.nombre', 'LIKE', "%{$this->busqueda}%")
                      ->orWhere('users.name', 'LIKE', "%{$this->busqueda}%");
            });
        }

        if ($this->busqueda_nombre_artista != "") {
            $productos->where('users.name', 'LIKE', "%{$this->busqueda_nombre_artista}%");
        }

        if ($this->busqueda_nombre_producto != "") {
            $productos->where('productos.nombre', 'LIKE', "%{$this->busqueda_nombre_producto}%");
        }

        if ($this->tema_id != "") {
            $tema = Tema::find($this->tema_id);
            $this->tema = $tema->slug;
            $this->tema_nombre = $tema->nombre;
            $productos->where('productos.tema_id', $this->tema_id);
        } else {
            $this->tema = "";
            $this->tema_nombre = "";
        }

        switch ($this->ordenamiento) {
            case 'precioDesc':
                $productos = $productos->orderBy('precio', "DESC");
                break;
            case 'precioAsc':
                $productos->orderBy('precio', "ASC");
                break;
            case 'stockDesc':
                $productos->orderBy('stock', 'DESC');
                break;
            case 'stockAsc':
                $productos->orderBy('stock', "ASC");
                break;
            default:
                // Si no se ha especificado un ordenamiento, simplemente se ordena por nombre.
                $productos->orderBy('productos.nombre', 'ASC');
        }

        $this->resetPaginaUno();

        return view('livewire.market.grid-productos', [
            'productos' => $productos->paginate($this->por_pagina),
            'categorias' => Categoria::all(),
            'temas' => Tema::all(),
        ]);
    }

    /**
     * Redirige a la página 1 solo si los filtros han cambiado.
     * para prevenir "no coincidencias" cuando se busca en una pagina > 1 y
     * no hay suficientes resultados para paginar hasta esa página X.
     */
    public function resetPaginaUno() {
        if ($this->busqueda_nombre_producto != $this->busqueda_nombre_producto_antigua) {
            $this->page = 1;
            $this->busqueda_nombre_producto_antigua = $this->busqueda_nombre_producto;
        }

        if ($this->tema_id != $this->tema_id_antigua) {
            $this->page = 1;
            $this->tema_id_antigua = $this->tema_id;
        }

        if ($this->busqueda_nombre_artista != $this->busqueda_nombre_artista_antigua) {
            $this->page = 1;
            $this->busqueda_nombre_artista_antigua = $this->busqueda_nombre_artista;
        }

        if ($this->ordenamiento != $this->ordenamiento_antiguo) {
            $this->page = 1;
            $this->ordenamiento_antiguo = $this->ordenamiento;
        }
    }
}
