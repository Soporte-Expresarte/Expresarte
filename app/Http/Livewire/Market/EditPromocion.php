<?php

namespace App\Http\Livewire\Market;

use App\Models\Promocion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EditPromocion extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $prop_id;
    public $titulo;
    public $descripcion;
    public $seccion_index;

    public $portada;
    public $banner;

    public $nueva_portada;
    public $nuevo_banner;

    public $rules = [
        'titulo' => 'required|min:3',
        'descripcion' => 'required|min:3|max:5000',
        'seccion_index' => 'required',
        //'banner' => 'required|image|mimes:png,jpg,jpeg|max:8192',
        //'portada' => 'required|image|mimes:png,jpg,jpeg|max:8192',
    ];

    protected $messages = [
        'titulo.required' => 'Debe ingresar un Título para la Promoción',
        'titulo.min' => 'A lo menos debe ingresar 3 caracteres',

        'descripcion.required' => 'Debe ingresar un Cuerpo para la Promoción',
        'descripcion.min' => 'A lo menos debe ingresar 3 caracteres',
        'descripcion.max' => 'A lo mas puede ingresar 5000 caracteres',

        'seccion_index.required' => 'Debe elegir una seccion para poder emplazar esta Promoción.',

        'nuevo_banner.required' => 'Debe ingresar una Imagen de portada para la Promoción',
        'nuevo_banner.image' => 'El archivo a subir únicamente puede ser una imagen.',
        'nuevo_banner.mimes' => 'La imagen a subir solo puede ser de formato png,jpg o jpeg.',
        'nuevo_banner.max' => 'El tamaño maximo de la imagen subida no puede superar los 2mb.',

        'nueva_portada.required' => 'Debe ingresar una Imagen tipo banner para portada de la Promoción',
        'nueva_portada.image' => 'El archivo a subir únicamente puede ser una imagen.',
        'nueva_portada.mimes' => 'La imagen a subir solo puede ser de formato png,jpg o jpeg.',
        'nueva_portada.max' => 'El tamaño maximo de la imagen subida no puede superar los 2mb.',
    ];

    public function mount($id_promo)
    {
        $the_promocion = Promocion::find($id_promo);
        $this->prop_id = $id_promo;

        $this->titulo = $the_promocion->titulo;
        $this->descripcion = $the_promocion->descripcion;
        $this->seccion_index = $the_promocion->bloque;

        $this->portada = $the_promocion->imagen_path;
        $this->banner = $the_promocion->banner_path;
    }

    public function render()
    {
        return view('livewire.market.edit-promocion');
    }

    public function update($id)
    {
        $promo_update = Promocion::find($id);
        $validaciones = $this->validate();

        $promo_update->update([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'bloque' => $this->seccion_index,
        ]);

        if ($this->nueva_portada) {
            $this->validate([
                'nueva_portada' => 'image|mimes:png,jpg,jpeg|max:2048',
            ], $this->messages);

            Storage::delete($this->portada);

            $promo_update->imagen_path = 'storage/' .
                (Storage::disk('public')
                    ->put('imagenes-market/promocion', $this->nueva_portada));

            $promo_update->save();
        }

        if ($this->nuevo_banner) {
            $this->validate([
                'nuevo_banner' => 'image|mimes:png,jpg,jpeg|max:2048',
            ], $this->messages);

            Storage::delete($this->banner);

            $promo_update->banner_path = 'storage/' .
                (Storage::disk('public')
                    ->put('imagenes-market/promocion', $this->nuevo_banner));

            $promo_update->save();
        }

        session()->flash('success', 'Promoción actualizada correctamente!');
        return redirect()->route('admin-promocion');
    }

    public function cancel()
    {
        session()->flash('success', 'Edición de Promoción cancelada');
        return redirect()->route('admin-promocion');
    }
}
