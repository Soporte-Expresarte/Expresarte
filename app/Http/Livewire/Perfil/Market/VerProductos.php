<?php

namespace App\Http\Livewire\Perfil\Market;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VerProductos extends Component
{
    use WithPagination;
    public $por_pagina = 3;

    public function render()
    {
        // Solamente los productos que estan en venta
        $myCollectionObj = Auth::user()->productos->where('en_venta', 1)->sortByDesc('updated_at');

        $data = $this->paginate($myCollectionObj, $this->por_pagina);
        return view('livewire.perfil.market.ver-productos', ['productos' => $data]);
    }

    public function paginate($items, $por_pagina, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $por_pagina), $items->count(), $por_pagina, $page, $options);
    }

    /**
     * Redirige a la pagina 1
     * para prevenir "no coincidencias" cuando buscas en una pagina >1 y
     * no hay suficientes resultados para paginar hasta esa pagina X
     */
    public function resetPaginaUno() {
        $this->page = 1;
    }

     /**
     * Elimina el producto.
     * @param integer $producto_id
     */
    public function eliminarProducto($producto_id) {
        app('App\Http\Controllers\ProductoController')->eliminar($producto_id);
    }

}
