<?php

namespace App\Http\Livewire\Galeria;

use App\Models\Exposicion;
use Livewire\Component;

class AdminExposiciones extends Component
{
    public function render()
    {
        return view('livewire.galeria.admin-exposiciones', [
            'expo_all' => Exposicion::all()
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('edit-expo', [
            'id' => $id
        ]);
    }

    public function delete(Exposicion $expo)
    {
        $expo->delete();

        session()->flash('success', 'Exposicion eliminada exitosamente');
        return redirect()->route('admin-expo');
    }
}
