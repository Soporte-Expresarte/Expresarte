<?php

namespace App\Http\Livewire\Galeria;

use App\Models\Evento;
use Livewire\Component;

class AdminEventos extends Component
{
    public $eventos;
    public function render()
    {
        return view('livewire.galeria.admin-eventos');
    }

    public function editar(Evento $evento) {
        return redirect()->route('editar-evento', ['evento' => $evento]);
    }

    public function eliminar(Evento $evento){

        app('App\Http\Controllers\EventoController')->eliminar($evento->id);
    }
}
