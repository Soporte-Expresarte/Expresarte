<?php

namespace App\Http\Livewire\Market;

use Livewire\Component;

class MensajesConfirmacionMarket extends Component
{
    public $mensajeSuccess;

    protected $listeners = ['productoAdded' => 'ImprimirMensajesConfirmacion'];

    public function render()
    {
        return view('livewire.market.mensajes-confirmacion-market');
    }

    public function ImprimirMensajesConfirmacion()
    {
        $this->mensajeSuccess = "Producto agregado al Carrito satisfactoriamente";
    }

    public function ImprimirMensajesEliminacion()
    {
        $this->mensajeSuccess = "Producto quitado del Carrito satisfactoriamente";
    }
}
