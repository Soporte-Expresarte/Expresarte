<?php

namespace App\Http\Livewire\Perfil\Galeria\Admin;

use App\Models\Obra;
use Livewire\Component;
use Livewire\WithPagination;

class AprobarObras extends Component
{

    use WithPagination;
    public function render()
    {
        $obras = Obra::orderBy('created_at', 'desc')->where('estado', 'PENDIENTE')->paginate(5);
        return view('livewire.perfil.galeria.admin.aprobar-obras',['obras'=>$obras]);
    }

    public function aprobado(Obra $obra)
    {
        app('App\Http\Controllers\ObraController')->aprobado($obra);
    }

    public function rechazado(Obra $obra)
    {
        app('App\Http\Controllers\ObraController')->rechazado($obra);
    }
}
