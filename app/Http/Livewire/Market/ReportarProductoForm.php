<?php

namespace App\Http\Livewire\Market;

use App\Models\Producto;
use Livewire\Component;

class ReportarProductoForm extends Component
{
    public $producto;
    public $razon;
    public $desc;

    protected $rules = [
        'razon' => 'required',
        'desc' => 'required|max:500|min:10'
    ];

    public $messages = [
        'razon.required' => 'Debe ingresar una razón.',

        'desc.required' => 'Debe ingresar una descripción.',
        'desc.max' => 'La descripción no puede tener más de 500 caracteres.',
        'desc.min' => 'La descripción debe tener al menos de 10 caracteres.'
    ];

    public function mount($id)
    {
        $this->producto = Producto::find($id);
    }

    /**
     * Validación en tiempo real
     *
     * @param mixed $desc Descripción del reporte
     * @param mixed $razon El motivo del reporte
     */
    public function updated($desc, $razon)
    {
        $this->validateOnly($razon);
        $this->validateOnly($desc);
    }

    /**
     * Ingresar reporte a la BD
     */
    public function reportar()
    {
        $this->validate();

        app('App\Http\Controllers\ReporteController')->ingresarReporte($this->producto, $this->razon, $this->desc);
        $this->clear();
        session()->flash('success', 'Reporte enviado satisfactoriamente.');
        return redirect()->route("ver-producto", ["slug" => $this->producto->slug]);
    }

    /**
     * Dejar en blanco variables del form
     */
    private function clear()
    {
        $this->desc = null;
        $this->razon = "";
    }

    public function render()
    {
        return view('livewire.market.reportar-producto-form');
    }
}
