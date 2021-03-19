<?php

namespace App\Http\Controllers;


use App\Models\Reporte;


class ReporteController extends Controller
{
    /**
     * Ingresar un reporte
     *
     * @param Producto $producto El producto a reportar
     * @param string $motivo La razón por la que se reporta
     * @param string $desc Una descripción opcional
     */
    public function ingresarReporte($producto, $motivo, $desc) {
        $data = [
            'motivo' => $motivo,
            'descripcion' => $desc,
            'producto_id' => $producto->id,
            'usuario_id' => auth()->user()->id,
            'artista_id' => $producto->usuario_id,
        ];

        Reporte::create($data);
    }


    /**
     * Elimina todo los reportes asociados al producto
     *
     * @param integer $producto_id
     */
    public function eliminarTodosReportes($producto_id) {
        Reporte::where('producto_id',$producto_id)->delete();
    }
    /**
     * Elimina el reporte.
     *
     * @param integer $reporte_id
     */
    public function eliminarReporte($reporte_id) {
        Reporte::where('id',$reporte_id)->delete();
    }

}
