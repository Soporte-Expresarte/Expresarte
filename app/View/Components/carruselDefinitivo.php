<?php

namespace App\View\Components;

use Illuminate\View\Component;

class carruselDefinitivo extends Component
{
    public $tipo;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if ($this->tipo == 'galeria') {
            return view('components.carrusel-definitivo', [
                'plana_1' => \App\Models\Carrusel::find(1),
                'plana_2' => \App\Models\Carrusel::find(2),
                'plana_3' => \App\Models\Carrusel::find(3)
            ]);
        } elseif ($this->tipo == 'artistas') {
            return view('components.carrusel-definitivo', [
                'plana_1' => \App\Models\Carrusel::find(4),
                'plana_2' => \App\Models\Carrusel::find(5),
                'plana_3' => \App\Models\Carrusel::find(6)
            ]);
        } elseif ($this->tipo == 'obras') {
            return view('components.carrusel-definitivo', [
                'plana_1' => \App\Models\Carrusel::find(7),
                'plana_2' => \App\Models\Carrusel::find(8),
                'plana_3' => \App\Models\Carrusel::find(9)
            ]);
        } elseif ($this->tipo == 'expo') {
            return view('components.carrusel-definitivo', [
                'plana_1' => \App\Models\Carrusel::find(10),
                'plana_2' => \App\Models\Carrusel::find(11),
                'plana_3' => \App\Models\Carrusel::find(12)
            ]);
        } elseif ($this->tipo == 'noticias') {
            return view('components.carrusel-definitivo', [
                'plana_1' => \App\Models\Carrusel::find(13),
                'plana_2' => \App\Models\Carrusel::find(14),
                'plana_3' => \App\Models\Carrusel::find(15)
            ]);
        } elseif ($this->tipo == 'eventos') {
            return view('components.carrusel-definitivo', [
                'plana_1' => \App\Models\Carrusel::find(16),
                'plana_2' => \App\Models\Carrusel::find(17),
                'plana_3' => \App\Models\Carrusel::find(18)
            ]);
        } elseif ($this->tipo == 'market') {
            return view('components.carrusel-definitivo', [
                'plana_1' => \App\Models\Carrusel::find(19),
                'plana_2' => \App\Models\Carrusel::find(20),
                'plana_3' => \App\Models\Carrusel::find(21)
            ]);
        } elseif ($this->tipo == 'crowd') {
            return view('components.carrusel-definitivo', [
                'plana_1' => \App\Models\Carrusel::find(22),
                'plana_2' => \App\Models\Carrusel::find(23),
                'plana_3' => \App\Models\Carrusel::find(24)
            ]);
        }

        return view('components.carrusel-definitivo');
    }
}
