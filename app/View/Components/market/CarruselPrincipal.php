<?php

namespace App\View\Components\market;

use Illuminate\View\Component;

class CarruselPrincipal extends Component
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
        return view('components.market.carrusel-principal', [
            'plana_19' => \App\Models\Carrusel::find(19),
            'plana_20' => \App\Models\Carrusel::find(20),
            'plana_21' => \App\Models\Carrusel::find(21)
        ]);
    }
}
