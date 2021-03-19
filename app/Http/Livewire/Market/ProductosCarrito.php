<?php

namespace App\Http\Livewire\Market;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class ProductosCarrito extends Component
{
    public $carrito;
    public $productos_carrito;

    public function mount() {
        // Define las variables a utilizar en el componente.
        $this->carrito = Auth::user()->carro;
        $this->productos_carrito = Auth::user()->carro->productos;
    }

    public function render()
    {
        return view('livewire.market.productos-carrito');
    }

    /**
     * Elimina un producto del carrito del usuario.
     *
     * @param integer $id
     */
    public function eliminarProducto($id) {
        // Desvincula un producto del carro respectivo.
        Auth::user()->carro->productos()->detach($id);

        $this->emit('productoAdded');
        $this->recalcularVariables();
    }

    /**
     * Actualiza la cantidad que se comprará de un producto
     */
    public function actualizarCantidad(Producto $producto, $cantidad) {
        // Activa el loader.
        $this->emit("inicioActualizarCantidad");

        if ($cantidad > $producto->stock || $cantidad <= 0) $cantidad = 1;

        // Actualiza la cantidad del producto en la tabla n-n.
        $producto->carros()->updateExistingPivot($this->carrito->id, ['cantidad' => $cantidad]);

        $this->emit('productoAdded');
        $this->recalcularVariables();

        $this->emit("finActualizarCantidad");
    }

    /**
     * Refresca las variables del componente y recalcula el monto total del carrito.
     */
    public function recalcularVariables() {
        // Actualiza las variables del componente.
        $this->carrito = Auth::user()->carro;
        $this->productos_carrito = Auth::user()->carro->productos;

        // Recalcula el monto total del carrito.
        $montoTotal = 0;
        foreach ($this->carrito->productos as $producto) {
            $montoTotal += $producto->precio * $producto->pivot->cantidad;
        }

        $this->emit('productoAdded');

        // Asigna el nuevo monto total y actualiza el carrito.
        $this->carrito->monto_total = $montoTotal;
        $this->carrito->save();
    }
}
