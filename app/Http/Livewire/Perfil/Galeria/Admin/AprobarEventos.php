<?php

namespace App\Http\Livewire\Perfil\Galeria\Admin;

use App\Models\Evento;
use Livewire\Component;
use Livewire\WithPagination;

class AprobarEventos extends Component
{
    use WithPagination;
    public function render()
    {
        $eventos = Evento::orderBy('created_at', 'desc')->where('estado', 'PENDIENTE')->paginate(5);
        return view('livewire.perfil.galeria.admin.aprobar-eventos',['eventos'=>$eventos]);
    }

    public function aprobado(Evento $evento)
    {
        app('App\Http\Controllers\EventoController')->aprobado($evento);
    }

    public function rechazado(Evento $evento)
    {
        app('App\Http\Controllers\EventoController')->rechazado($evento);
    }
}
