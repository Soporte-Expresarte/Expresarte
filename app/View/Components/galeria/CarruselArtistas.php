<?php

namespace App\View\Components\galeria;

use App\Models\Carrusel;
use Illuminate\View\Component;

class CarruselArtistas extends Component
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
        return view('components.galeria.carrusel-artistas', [
            'plana_4' => Carrusel::find(4),
            'plana_5' => Carrusel::find(5),
            'plana_6' => Carrusel::find(6),
        ]);
    }
}
