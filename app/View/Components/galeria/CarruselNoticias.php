<?php

namespace App\View\Components\galeria;

use Illuminate\View\Component;

class CarruselNoticias extends Component
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
        return view('components.galeria.carrusel-noticias', [
            'plana_13' => \App\Models\Carrusel::find(13),
            'plana_14' => \App\Models\Carrusel::find(14),
            'plana_15' => \App\Models\Carrusel::find(15)
        ]);
    }
}
