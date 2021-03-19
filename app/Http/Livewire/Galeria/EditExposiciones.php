<?php

namespace App\Http\Livewire\Galeria;

use App\Models\Exposicion;
use App\Models\Obra;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditExposiciones extends Component
{
    public $prop_id;
    public $titulo;
    public $sub_titulo;
    public $descripcion;

    public $current_obra;
    public $currents_obras = array();

    public $obra_box_box;

    public $rules = [
        'titulo' => 'required|min:3',
        'sub_titulo' => 'required|min:3|max:300',
        'descripcion' => 'required|min:10|max:5000',
        'currents_obras' => 'array|min:4|max:65',
    ];

    protected $messages = [
        'titulo.required' => 'Debe ingresar un Título para la Noticia',
        'titulo.min' => 'A lo menos debe ingresar 3 caracteres',

        'sub_titulo.required' => 'Debe ingresar un Subtítulo para la Noticia',
        'sub_titulo.min' => 'A lo menos debe ingresar 3 caracteres',
        'sub_titulo.max' => 'A lo más puede ingresar 300 caracteres',

        'descripcion.required' => 'Debe ingresar una Bajada para la Noticia',
        'descripcion.max' => 'A lo más puede ingresar 5000 caracteres',
        'descripcion.min' => 'A lo menos debe ingresar 10 caracteres',

        'currents_obras.required' => 'Debe existir un conjunto de obras elegidas',
        'currents_obras.array' => 'Debe existir un conjunto de obras guardadas en forma de lista',
        'currents_obras.min' => 'Al menos deben existir 4 obras para crear una exposicion',
        'currents_obras.max' => 'A lo más puede ingresar 64 Obras',
        'currents_obras.unique' => 'Las obras en la exposicion deben ser únicas',
    ];

    public function mount($id)
    {
        $la_expo = Exposicion::find($id);
        $this->prop_id = $id;

        foreach (Exposicion::find($id)->obras as $obras)
            array_push($this->currents_obras, $obras->id);

        $this->titulo = $la_expo->titulo;
        $this->sub_titulo = $la_expo->sub_titulo;
        $this->descripcion = $la_expo->descripcion;
        //$this->currents_obras = Exposicion::find($id)->obras;
    }

    public function render()
    {
        return view('livewire.galeria.edit-exposiciones', [
            'obras_aprobadas' => Obra::all()->where('estado', '=', 'APROBADO')
        ]);
    }

    public function update($id)
    {
        $la_expo = Exposicion::find($id);
        $validaciones = $this->validate();

        $la_expo->update([
            'titulo' => $this->titulo,
            'sub_titulo' => $this->sub_titulo,
            'descripcion' => $this->descripcion,
        ]);

        $la_expo->obras()->detach();

        foreach ($this->currents_obras as $obra_id)
            $la_expo->obras()->attach($obra_id);

        session()->flash('success', 'Exposición actualizada correctamente!');
        return redirect()->route('admin-expo');


    }

    public function cancel()
    {
        session()->flash('success', 'Edición de Promoción cancelada');
        return redirect()->route('admin-expo');
    }

    public function removeObra($id)
    {
        $this->validate([
            'currents_obras' => 'array|min:5|max:65',
        ], $this->messages);

        unset($this->currents_obras[array_search($id, $this->currents_obras)]);
        $obras_update = array_values($this->currents_obras);
        $this->currents_obras = $obras_update;
    }

    public function addObra()
    {
        if ($this->current_obra == "") {
            throw ValidationException::withMessages([
                'current_obra' => 'Debe elegir una Obra para agregar.'
            ]);
        } else {
            if (!in_array($this->current_obra, $this->currents_obras)) {
                array_push($this->currents_obras, $this->current_obra);
                $this->reset('current_obra');
            } else {
                throw ValidationException::withMessages([
                    'currents_obras' => 'Las Obras registradas para la Exposicion deben ser unicas.'
                ]);
            }
        }
    }
}
