<?php

namespace App\Http\Livewire\Galeria;

use App\Models\Carrusel;
use Livewire\Component;

class AdminCarruseles extends Component
{
    public function render()
    {
        return view('livewire.galeria.admin-carruseles');
    }

    public function edit($id)
    {
        return redirect()->route('create-carruse', [
            'id' => $id
        ]);
    }
}
