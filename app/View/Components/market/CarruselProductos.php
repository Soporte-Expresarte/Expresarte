<?php

namespace App\View\Components\market;

use Illuminate\View\Component;
use App\Models\Producto;

class CarruselProductos extends Component
{

    public $tipo;
    public $productos;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tipo)
    {
        $this->tipo = $tipo;

        if ($this->tipo == "masNuevos") {
            $this->productos = Producto::all()->where('en_venta', 1)->sortByDesc('created_at')->take(16);
        } else if ($this->tipo == "masVendidos") {
            $this->productos = Producto::all()->where('en_venta', 1)->sortByDesc('vendidos')->take(16);
        } else if ($this->tipo == "unicos") {
            $this->productos = Producto::all()->where('en_venta', 1)->where('stock', 1)->take(16);
        } else {
            // El tipo recibido es en realidad un producto individual.
            $this->productos = $tipo->artista->productos()->where('en_venta', 1)->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.market.carrusel-productos');
    }
}
