<?php

namespace App\Http\Livewire\Perfil\Market;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class GestionDespachosOrdenes extends Component
{
    use WithPagination;
    public $por_pagina = "9";
    public $asc_desc = "desc";
    public $busqueda_nombre_antigua = "";
    public $busqueda_nombre = "";
    public $busqueda_apellido_antigua = "";
    public $busqueda_apellido = "";
    public $busqueda_producto_antigua = "";
    public $busqueda_producto = "";

    public function render()
    {
        $productos = Producto::select('productos.*', 'ordenes_productos.cantidad as cantidad_comprada', 
        'ordenes_productos.id as ordenes_productos_id',"despachos.numero_hogar as numero_hogar", "despachos.calle as calle", 
        "despachos.pais as pais", "despachos.region as region", "despachos.comuna as comuna", "despachos.compania_despacho as compania_despacho",
        "despachos.n_seguimiento as n_seguimiento", "despachos.nombre as nombre_destinatario", "despachos.apellido as apellido_destinatario",
        "despachos.celular as celular_contacto", "despachos.created_at as despacho_created_at")
        ->join('ordenes_productos', 'productos.id', '=','ordenes_productos.producto_id')
        ->join('ordenes', 'ordenes_productos.orden_id', '=', 'ordenes.id')
        ->join('despachos', 'ordenes.despacho_id', '=', 'despachos.id')
        ->join('users as artistas', 'productos.usuario_id', '=','artistas.id')
        ->where('artistas.id', Auth::user()->id)
        ->where('ordenes_productos.enviado', '=', 0);

        if(!empty($this->busqueda_nombre)) {
            $productos->where('nombre_destinatario','LIKE',"%{$this->busqueda_nombre}%");
            $this->resetPaginaUno();
        }

        if(!empty($this->busqueda_apellido)){
            $productos->where('apellido_destinatario','LIKE',"%{$this->busqueda_apellido}%");
            $this->resetPaginaUno();
        }
        if(!empty($this->busqueda_producto)){
            $productos->where('productos.nombre','LIKE',"%{$this->busqueda_producto}%");
            $this->resetPaginaUno();
        }

        return view('livewire.perfil.market.gestion-despachos-ordenes', [
            'productos' => $productos
            ->orderBy('ordenes.created_at', $this->asc_desc)
            ->paginate($this->por_pagina),
        ]);
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
        if ($this->busqueda_nombre != $this->busqueda_nombre_antigua) {
            $this->page = 1;
            $this->busqueda_nombre_antigua = $this->busqueda_nombre;
        }

        if ($this->busqueda_apellido != $this->busqueda_apellido_antigua) {
            $this->page = 1;
            $this->busqueda_apellido_antigua = $this->busqueda_apellido;
        }

        if ($this->busqueda_producto != $this->busqueda_producto_antigua) {
            $this->page = 1;
            $this->busqueda_producto_antigua = $this->busqueda_producto;
        }
    }

        /**
     * Cambia el estado del producto asignado a enviado en la orden.
     *
     * @param integer $ordenes_productos_id
     */
    public function productoEnviado($ordenes_productos_id) {
        DB::table('ordenes_productos')->where('id', $ordenes_productos_id)->update(['enviado' => 1]);

    }

}
