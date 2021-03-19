<?php

namespace App\View\Components;

use Illuminate\View\Component;

class crowdfunding.carrusel - principal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public
    function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public
    function render()
    {
        return view('components.crowdfunding.carrusel-principal', [
            'plana_22' => \App\Models\Carrusel::find(22),
            'plana_23' => \App\Models\Carrusel::find(23),
            'plana_24' => \App\Models\Carrusel::find(24)
        ]);
    }
}
