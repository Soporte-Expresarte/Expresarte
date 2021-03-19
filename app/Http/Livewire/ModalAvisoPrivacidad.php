<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ModalAvisoPrivacidad extends Component
{
    public $la_sesion;
    public $aux = 0;

    public function mount()
    {
        $this->la_sesion = \App\Models\Session::where('id', \Illuminate\Support\Facades\Session::getId())->first();
    }

    public function render()
    {
        return view('livewire.modal-aviso-privacidad');
    }

    public function loadView()
    {
        $this->aux++;
        $this->la_sesion = \App\Models\Session::where('id', \Illuminate\Support\Facades\Session::getId())->first();
    }

    public function aceptar()
    {
        $this->la_sesion->update(['with_cookies' => 'SI']);
    }
}
