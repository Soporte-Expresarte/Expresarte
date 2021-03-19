<?php

namespace App\View\Components\galeria;

use App\Models\Carrusel;
use Illuminate\View\Component;

class CarruselExposiciones extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.galeria.carrusel-exposiciones', [
            'plana_7' => Carrusel::find(7),
            'plana_8' => Carrusel::find(8),
            'plana_9' => Carrusel::find(9),
        ]);
    }
}
