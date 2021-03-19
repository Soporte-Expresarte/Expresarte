<?php

namespace App\Http\Livewire\Market;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FormCreatePromocion extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $titulo;
    public $descripcion;
    public $seccion_index = 'SUPERIOR';

    public $portada;
    public $banner;

    public $nueva_portada;
    public $nueva_banner;

    public $rules = [
        'titulo' => 'required|min:3',
        'descripcion' => 'required|min:3|max:5000',
        'seccion_index' => 'required',
        'banner' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        'portada' => 'required|image|mimes:png,jpg,jpeg|max:2048',
    ];

    protected $messages = [
        'titulo.required' => 'Debe ingresar un Título para la Promoción',
        'titulo.min' => 'A lo menos debe ingresar 3 caracteres',

        'descripcion.required' => 'Debe ingresar un Cuerpo para la Promoción',
        'descripcion.min' => 'A lo menos debe ingresar 3 caracteres',
        'descripcion.max' => 'A lo mas puede ingresar 5000 caracteres',

        'seccion_index.required' => 'Debe elegir una seccion para poder emplazar esta Promoción.',

        'banner.required' => 'Debe ingresar una Imagen de portada para la Promoción',
        'banner.image' => 'El archivo a subir únicamente puede ser una imagen.',
        'banner.mimes' => 'La imagen a subir solo puede ser de formato png,jpg o jpeg.',
        'banner.max' => 'El tamaño maximo de la imagen subida no puede superar los 2mb.',

        'portada.required' => 'Debe ingresar una Imagen tipo banner para portada de la Promoción',
        'portada.image' => 'El archivo a subir únicamente puede ser una imagen.',
        'portada.mimes' => 'La imagen a subir solo puede ser de formato png,jpg o jpeg.',
        'portada.max' => 'El tamaño maximo de la imagen subida no puede superar los 2mb.',
    ];

    public function render()
    {
        return view('livewire.market.form-create-promocion');
    }

    public function store()
    {
        $validatedData = $this->validate();
        app('App\Http\Controllers\PromocionController')->store($validatedData, $this->portada, $this->banner);
    }
}
