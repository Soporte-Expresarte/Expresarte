<?php

namespace App\View\Components\market;

use Illuminate\View\Component;

class SliderProductos extends Component
{
    public $imagenes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($imagenes)
    {
        $this->imagenes = $imagenes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.market.slider-productos');
    }
}
