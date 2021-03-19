<?php

namespace App\Http\Livewire\Perfil;

use Livewire\WithPagination;
use Livewire\Component;

class VistaPerfil extends Component
{
    use WithPagination;

    public $vista;

    public function mount()
    {
        // Si hay registros de la página anterior (la URL tiene que ser del dominio de Expresarte).
        if (isset($_SERVER['HTTP_REFERER'])) {
            // Basado en la página de la cual se está entrando al perfil, se pone cierta pestaña por defecto.

            // Busca coincidencias en la url para market, crowdfunding o galeria.
            preg_match("~market|crowdfunding|galeria~", $_SERVER['HTTP_REFERER'], $matches);

            // Si encuentra una de estas, carga el perfil con cierta vista activa, caso contrario muestra la información personal.
            $this->vista = (isset($matches[0]) ? "informacion_" . $matches[0] : "informacion_personal");
        } else {
            // Si se viene de una página que no es parte del dominio de Expresarte, simplemente se carga la vista de información personal.
            $this->vista = "informacion_personal";
        }

    }

    public function render()
    {
        return view('livewire.perfil.vista-perfil', [
            'la_vista' => $this->vista
        ]);
    }

    public function changing()
    {
        $this->vista == 'informacion_galeria';
        return $this->vista;
    }

}
