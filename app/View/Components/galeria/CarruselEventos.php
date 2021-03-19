<?php

namespace App\View\Components\galeria;

use Illuminate\View\Component;

class CarruselEventos extends Component
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
        return view('components.galeria.carrusel-eventos', [
            'plana_16' => \App\Models\Carrusel::find(16),
            'plana_17' => \App\Models\Carrusel::find(17),
            'plana_18' => \App\Models\Carrusel::find(18)
        ]);
    }
}
