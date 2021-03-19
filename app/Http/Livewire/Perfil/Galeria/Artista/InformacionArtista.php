<?php

namespace App\Http\Livewire\Perfil\Galeria\Artista;

use Livewire\Component;

class InformacionArtista extends Component
{

    public $vistaArtista = 'datos-artista';

    public function render()
    {
        return view('livewire.perfil.galeria.artista.informacion-artista');
    }
}
