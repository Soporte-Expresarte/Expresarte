<?php

namespace App\Http\Livewire\Perfil\Market;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Reporte;
use App\Models\User;

class VerReportes extends Component
{
    use WithPagination;
    public $por_pagina = "9";
    
    public $busqueda_nombre_producto_antigua ="";
    public $busqueda_nombre_producto ="";
    public $busqueda_nombre_artista_antigua ="";
    public $busqueda_nombre_artista ="";
    public $busqueda_nombre_acusador_antigua ="";
    public $busqueda_nombre_acusador ="";

    public $motivo;
    public $asc_desc = "desc";

    public function render()
    {
        $reportes = Reporte::select('reportes.*','productos.nombre','artistas.name as artista_name','artistas.apellido as artista_apellido','acusadores.name as acusador_name','acusadores.apellido as acusador_apellido')
            ->leftjoin('productos','reportes.producto_id','=','productos.id')
            ->leftjoin('users as artistas','reportes.artista_id','=','artistas.id')
            ->leftjoin('users as acusadores','reportes.usuario_id','=','acusadores.id');

        if(!empty($this->motivo)){
            $reportes->where('reportes.motivo',$this->motivo);
            $this->resetPaginaUno();
        }

        if(!empty($this->busqueda_nombre_producto)){
            $reportes->where('productos.nombre','LIKE',"%{$this->busqueda_nombre_producto}%");
            $this->resetPaginaUno();
        }

        if(!empty($this->busqueda_nombre_artista)){
            $reportes->where('artistas.name','LIKE',"%{$this->busqueda_nombre_artista}%");
            $this->resetPaginaUno();
        }

        if(!empty($this->busqueda_nombre_acusador)){
            $reportes->where('acusadores.name','LIKE',"%{$this->busqueda_nombre_acusador}%");
            $this->resetPaginaUno();
        }

        return view('livewire.perfil.market.ver-reportes',[
            'reportes' => $reportes
            ->orderBy('reportes.created_at', $this->asc_desc)
            ->paginate($this->por_pagina)
        ]);
    }

    /**
     * Redirige a la página 1.
     * Para prevenir "no coincidencias" cuando buscas en una pagina >1 y
     * no hay suficientes resultados para paginar hasta esa página X.
     */
    public function resetPaginaUno() {
        if ($this->busqueda_nombre_producto != $this->busqueda_nombre_producto_antigua) {
            $this->page = 1;
            $this->busqueda_nombre_producto_antigua = $this->busqueda_nombre_producto;
        }

        if ($this->busqueda_nombre_acusador != $this->busqueda_nombre_acusador_antigua) {
            $this->page = 1;
            $this->busqueda_nombre_acusador_antigua = $this->busqueda_nombre_acusador;
        }

        if ($this->busqueda_nombre_artista != $this->busqueda_nombre_artista_antigua) {
            $this->page = 1;
            $this->busqueda_nombre_artista_antigua = $this->busqueda_nombre_artista;
        }
    }

    /**
     * Elimina el producto y todos los reportes asociados.
     *
     * @param integer $producto_id
     */
    public function eliminarProducto($producto_id) {
        app('App\Http\Controllers\ReporteController')->eliminarTodosReportes($producto_id);
        app('App\Http\Controllers\ProductoController')->eliminar($producto_id);
    }

     /**
     * Elimina el reporte.
     *
     * @param integer $reporte_id
     */
    public function eliminarReporte($reporte_id) {
        app('App\Http\Controllers\ReporteController')->eliminarReporte($reporte_id);
        session()->flash('success', 'El reporte ha sido eliminado satisfactoriamente.');
        return redirect()->back();
        //return view([VistaPerfil::class]);
    }

}
