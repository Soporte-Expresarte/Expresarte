<?php

namespace App\Http\Livewire\Perfil\Market;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VerOrdenes extends Component
{
    use WithPagination;

    public function render()
    {
        $myCollectionObj = Auth::user()->ordenes;
  
        $data = $this->paginate($myCollectionObj);
   
        return view('livewire.perfil.market.ver-ordenes', ['ordenes' => $data]);
    }

    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
