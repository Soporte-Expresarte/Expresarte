<?php

namespace App\Http\Livewire\Market;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Categoria;

class Buscador extends Component
{
    public $texto;
    public $carrito_num;
    public $ordenamiento_all;

    public $hay_resultados;
    public $on_index;
    protected $listeners = ['productoAdded' => 'incrementCarritoCount'];


    public function mount()
    {
        $this->carrito_num = (Auth::check() && Auth::id() != 1) ? Auth::user()->carro->productos->count() : 0;

        $this->ordenamiento_all = [
            'Alfabetico',
            'Novedades',
            'Precio de menor a mayor',
            'Precio de mayor a menor',
            'Recomendados',
        ];

        //$this->hay_resultados = 'no';
    }

    public function render()
    {
        return view('livewire.market.buscador');
    }

    public $rules = [
        'texto' => 'required|min:1|max:255',
    ];

    protected $messages = [
        // texto de busqueda
        'texto.required' => 'Este es un campo obligatorio.',
        'texto.min' => 'Por favor, ingrese 1 o más carácteres.',
    ];


    public function incrementCarritoCount()
    {
        $this->carrito_num = Auth::user()->carro->productos->count();
    }


    /**
     * Redirige a la ruta para buscar productos por el texto escrito en la barra.
     * En GridProductos.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buscar_por_texto()
    {
        $this->validate();
        return redirect()->route('buscarPorTexto', [
            'texto' => $this->texto,
        ]);
    }

    public function ver_carrito()
    {
        return redirect()->route('carrito');
    }

}
