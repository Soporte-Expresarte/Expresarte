<?php

namespace App\Http\Livewire\Crowdfunding;

use Livewire\Component;

class AutorizarProyectoComponent extends Component
{

    public $proyecto;

    public function render()
    {
        return view('livewire.crowdfunding.autorizar-proyecto-component');
    }

}
