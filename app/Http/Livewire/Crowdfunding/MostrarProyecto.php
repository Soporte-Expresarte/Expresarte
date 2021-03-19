<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MostrarProyecto extends Component
{

    public $pestaña = 'descripcion';

    public function render()
    {
        return view('livewire.crowdfunding.mostrar-proyecto');
    }
}
