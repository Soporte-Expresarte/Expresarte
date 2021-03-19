<?php

namespace App\Http\Livewire\Utilidades;

use Livewire\Component;

class GeneralNavbar extends Component
{

    public $background;
    public $colorNavLinks;

    /**
     * Ejecutado antes de render(). Settea las variables recibidas en el componente.
     */
    public function mount($background, $colorNavLinks) {
        $this->background = $background;
        $this->colorNavLinks = $colorNavLinks;
    }

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-dropdown' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.utilidades.general-navbar');
    }
}
