<?php

namespace App\View\Components;

use Illuminate\View\Component;

class carrusel_expo extends Component
{

    public $plana_10;
    public $plana_11;
    public $plana_12;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->plana_10 = \App\Models\Carrusel::find(10);
        $this->plana_11 = \App\Models\Carrusel::find(11);
        $this->plana_12 = \App\Models\Carrusel::find(12);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.galeria.carrusel-expo', [
            'plana_10' => $this->plana_10,
            'plana_11' => $this->plana_11,
            'plana_12' => $this->plana_12
        ]);
    }
}
