<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MostrarProyecto extends Component
{

    public $pesta�a = 'descripcion';

    public function render()
    {
        return view('livewire.crowdfunding.mostrar-proyecto');
    }
}
