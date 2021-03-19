<?php

namespace App\Http\Livewire\Perfil\Galeria\Admin;

use Livewire\Component;

class PerfilAdmin extends Component
{
    public $vistaAdmin = 'aprobar-obras';
    
    public function render()
    {
        return view('livewire.perfil.galeria.admin.perfil-admin');
    }
}