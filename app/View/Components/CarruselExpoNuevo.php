<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CarruselExpoNuevo extends Component
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
        return view('components.carrusel-expo-nuevo', [
            'plana_10' => \App\Models\Carrusel::find(10),
            'plana_11' => \App\Models\Carrusel::find(11),
            'plana_12' => \App\Models\Carrusel::find(12)
        ]);
    }
}
