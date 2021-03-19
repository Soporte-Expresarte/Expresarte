<?php

namespace App\Http\Livewire\Crowdfunding;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proyecto;

class ListadoProyectos extends Component
{
    use WithPagination;

    public $busqueda = '';
    public $busqueda_antigua = '';

    public function render()
    {
        // reset de pagina cuando se cambia un filtro
        if($this->busqueda != $this->busqueda_antigua)
        {
            $this->page = 1;
        }

        //actualizacion de valores antiguos
        $this->busqueda_antigua = $this->busqueda;

        return view('livewire.crowdfunding.listado-proyectos',[
            'proyectos' => Proyecto::buscar($this->busqueda)
                ->orderBy('id','DESC')
                ->where('aprobado','SI')
                ->where('estado','EN CURSO')
                ->simplePaginate(3)
        ]);
    }
}
