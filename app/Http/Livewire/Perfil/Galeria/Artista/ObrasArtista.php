<?php

namespace App\Http\Livewire\Perfil\Galeria\Artista;

use Livewire\Component;
use App\Models\Obra;

use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ObrasArtista extends Component
{
    use WithPagination;
    public function render()
    {
        $misObras = Obra::orderBy('created_at', 'desc')->where('usuario_id', Auth::user()->id)->paginate(5);

        return view('livewire.perfil.galeria.artista.obras-artista',['obras'=>$misObras]);
    }
}
