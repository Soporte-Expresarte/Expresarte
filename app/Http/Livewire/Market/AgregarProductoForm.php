<?php

namespace App\Http\Livewire\Market;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AgregarProductoForm extends Component
{
    public $producto;
    public $productoEnCarrito;
    public $cantidad = 1;

    public $isCard;
    public $rules = [];

    public function mount()
    {

        $this->rules = [
            'cantidad' => 'required|numeric|gte:1|lte:' . $this->producto->stock
        ];
        if (Auth::check()) {
            $this->productoEnCarrito = (Auth::user()->currentTeam->name == "Administradores") ?
                false :
                Auth::user()->carro->productos()->find($this->producto->id) != null;
        }
    }

    public $messages = [
        'cantidad.required' => 'Se debe especificar una cantidad.',
        'cantidad.numeric' => 'Debe ingresar un número.',
        'cantidad.gte' => 'La cantidad debe ser mayor o igual a 1.',
        'cantidad.lte' => 'La cantidad no debe sobrepasar el stock disponible.'
    ];

    public function render()
    {
        return ($this->isCard != 'si') ?
            view('livewire.market.agregar-producto-form') :
            view('livewire.market.botones-carrito-card', [
                'producto_artista' => $this->producto
            ]);
    }

    /**
     * Agrega un producto al carrito del usuario
     */
    public function agregar()
    {
        $carrito = Auth::user()->carro;
        $this->validate();

        // Usuario ingresa un stock mayor al disponible.
        if ($this->producto->stock < $this->cantidad) {
            session()->flash('failure', 'Stock insuficiente.');
            return redirect()->route("ver-producto", ["slug" => $this->producto->slug]);
        }

        // Agregar nuevo producto al carrito.
        $carrito->productos()->attach([$this->producto->id], ['cantidad' => $this->cantidad]);

        // Recalcula el monto total del carrito.
        $montoTotal = 0;
        foreach ($carrito->productos as $producto)
            $montoTotal += $producto->precio * $producto->pivot->cantidad;

        $this->productoEnCarrito = true;

        // Asigna el nuevo monto total y actualiza el carrito.
        $carrito->monto_total = $montoTotal;
        $carrito->save();


        session()->flash('success', 'Producto agregado al carrito satisfactoriamente.');
        $this->emit('productoAdded');

        //return redirect()->route("ver-producto", ["slug" => $this->producto->slug]);
    }

    public function borrarDelCarrito($id)
    {
        // Desvincula un producto del carro respectivo.
        Auth::user()->carro->productos()->detach($id);

        // Actualiza las variables del componente.
        $carrito = Auth::user()->carro;

        // Recalcula el monto total del carrito.
        $montoTotal = 0;
        foreach ($carrito->productos as $producto)
            $montoTotal += $producto->precio * $producto->pivot->cantidad;

        $this->productoEnCarrito = false;

        // Asigna el nuevo monto total y actualiza el carrito.
        $carrito->monto_total = $montoTotal;
        $carrito->save();

        session()->flash('success', 'Producto eliminado del carrito satisfactoriamente.');
        $this->emit('productoAdded');

        //return redirect()->route("ver-producto", ["slug" => $this->producto->slug]);
    }

    public function registrarsePrimero()
    {
        return redirect()->route('login');
    }

}
