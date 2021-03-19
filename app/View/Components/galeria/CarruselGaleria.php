<?php

namespace App\View\Components\galeria;

use App\Models\Carrusel;
use Illuminate\View\Component;

class CarruselGaleria extends Component
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
        return view('components.galeria.carrusel-galeria', [
            'plana_1' => Carrusel::find(1),
            'plana_2' => Carrusel::find(2),
            'plana_3' => Carrusel::find(3),
        ]);
    }
}
