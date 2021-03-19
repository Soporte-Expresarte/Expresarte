<?php

namespace App\Http\Livewire\Market;

use App\Models\Promocion;
use Livewire\Component;

class AdminPromocion extends Component
{
    public function render()
    {
        return view('livewire.market.admin-promocion', [
            'promociones' => Promocion::all()
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('edit-promocion', [
            'id' => $id
        ]);
    }

    public function delete(Promocion $promo)
    {
        $promo->delete();

        session()->flash('success', 'Promoción eliminada exitosamente');
        return redirect()->route('admin-promocion');
    }
}
