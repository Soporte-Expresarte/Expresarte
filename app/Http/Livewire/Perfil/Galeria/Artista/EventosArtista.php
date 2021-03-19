<?php

namespace App\Http\Livewire\Perfil\Galeria\Artista;

use Livewire\Component;
use App\Models\Evento;

use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class EventosArtista extends Component
{
    use WithPagination;
    public function render()
    {
        $misEventos = Evento::orderBy('created_at', 'desc')->where('usuario_id', Auth::user()->id)->paginate(5);

        return view('livewire.perfil.galeria.artista.eventos-artista',['eventos'=>$misEventos]);
    }
}
