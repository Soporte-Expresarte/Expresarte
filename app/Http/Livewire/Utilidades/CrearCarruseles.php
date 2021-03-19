<?php

namespace App\Http\Livewire\Utilidades;

use App\Models\Carrusel;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CrearCarruseles extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $car_id;
    public $titulo;
    public $descripcion;
    public $link;

    public $banner;
    public $nuevo_banner;

    public $rules = [
        'titulo' => 'max:64',
        'descripcion' => 'max:255',
    ];

    protected $messages = [
        'titulo.required' => 'Debe ingresar un Título para la Noticia',
        'titulo.min' => 'A lo menos debe ingresar 3 caracteres',
        'titulo.max' => 'A lo más puede ingresar 64 caracteres',

        'descripcion.required' => 'Debe ingresar una Bajada para la Noticia',
        'descripcion.max' => 'A lo más puede ingresar 255 caracteres',
        'descripcion.min' => 'A lo menos debe ingresar 3 caracteres',
    ];

    public function mount($id)
    {
        $carrusel_uni = Carrusel::find($id);
        $this->car_id = $id;
        $this->titulo = $carrusel_uni->titulo;
        $this->descripcion = $carrusel_uni->descripcion;
        $this->banner = $carrusel_uni->banner;
    }

    public function render()
    {
        return view('livewire.utilidades.crear-carruseles');
    }

    public function update($id)
    {
        $promo_update = Carrusel::find($id);
        $validaciones = $this->validate();

        $promo_update->update([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'link' => $this->link
        ]);

        if ($this->nuevo_banner) {
            $this->validate([
                'nuevo_banner' => 'image|mimes:png,jpg,jpeg|max:8192',
            ], $this->messages);

            Storage::delete($this->banner);

            $promo_update->banner = 'storage/' .
                (Storage::disk('public')
                    ->put('imagenes-market/promocion', $this->nuevo_banner));

            $promo_update->save();
        }

        session()->flash('success', 'Carrusel actualizado correctamente!');
        return redirect()->route('admin-carrusel');
    }
}
