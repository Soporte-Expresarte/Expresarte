<?php

namespace App\Http\Livewire\Galeria;

use App\Models\Noticia;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use function PHPUnit\Framework\throwException;

class AdminNoticias extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $id_noticia;
    public $titulo;
    public $sub_titulo;
    public $bajada;
    public $cuerpo;

    public $imagen;
    public $portada;
    public $nueva_imagen;
    public $nueva_portada;
    public $fecha_noticia;

    public $current_tags = array();
    public $current_tag;
    public $for_new_tag;

    public $action;

    public $rules = [
        'titulo' => 'required|min:3',
        'sub_titulo' => 'required|min:3',
        'bajada' => 'required|max:5000',
        'cuerpo' => 'required|max:10000',
        'imagen' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        'portada' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        'current_tags' => 'required|array|min:1'
    ];

    protected $messages = [
        'titulo.required' => 'Debe ingresar un Título para la Noticia',
        'titulo.min' => 'A lo menos debe ingresar 3 caracteres',

        'sub_titulo.required' => 'Debe ingresar un Subtítulo para la Noticia',
        'sub_titulo.min' => 'A lo menos debe ingresar 3 caracteres',

        'bajada.required' => 'Debe ingresar una Bajada para la Noticia',
        'bajada.max' => 'A lo mas puede ingresar 5000 caracteres',

        'cuerpo.required' => 'Debe ingresar un Cuerpo para la Noticia',
        'cuerpo.max' => 'A lo mas puede ingresar 10000 caracteres',

        'imagen.required' => 'Debe ingresar una Imagen para la Noticia',
        'imagen.image' => 'El archivo a subir unicamente puede ser una imagen.',
        'imagen.mimes' => 'La imagen a subir solo puede ser de formato png,jpg o jpeg.',
        'imagen.max' => 'El tamaño maximo de la imagen subida no puede superar los 8mb.',

        'portada.required' => 'Debe ingresar una Imagen tipo banner para portada de la Noticia',
        'portada.image' => 'El archivo a subir unicamente puede ser una imagen.',
        'portada.mimes' => 'La imagen a subir solo puede ser de formato png,jpg o jpeg.',
        'portada.max' => 'El tamaño maximo de la imagen subida no puede superar los 2mb.',

        'nueva_imagen.required' => 'Debe ingresar una Imagen para la Noticia',
        'nueva_imagen.image' => 'El archivo a subir unicamente puede ser una imagen.',
        'nueva_imagen.mimes' => 'La imagen a subir solo puede ser de formato png,jpg o jpeg.',
        'nueva_imagen.max' => 'El tamaño maximo de la imagen subida no puede superar los 2mb.',

        'current_tags.array' => 'Debe dejar al menos un Tag para la Noticia',
        'current_tags.min' => 'Debe dejar al menos un Tag para la Noticia',
        'for_new_tag.max' => 'A lo más el Tag puede tener hasta 16 caracteres'

    ];

    public function mount($action)
    {
        $this->action = $action;
    }

    public function render()
    {
        if ($this->action == 'create')
            return view('livewire.galeria.form-create-noticia', [
                'tags' => Tag::all(),
                'current_tags' => $this->current_tags
            ]);

        if ($this->action == 'edit')
            return view('livewire.galeria.form-edit-noticia', [
                'tags' => Tag::all(),
                'current_tags' => $this->current_tags
            ]);

        if ($this->action == 'admin')
            return view('livewire.galeria.admin-noticias', [
                'noticias' => Noticia::all()
            ]);

        return redirect('/galeria/noticias');
    }

    public function edit(Noticia $noticia)
    {
        $this->action = 'edit';
        $tags_en_noticia = $noticia->tags()->get();

        foreach ($tags_en_noticia as $tag_completo)
            array_push($this->current_tags, $tag_completo->id);

        $this->id_noticia = $noticia->id;
        $this->titulo = $noticia->titulo;
        $this->sub_titulo = $noticia->sub_titulo;
        $this->bajada = $noticia->bajada;
        $this->cuerpo = $noticia->cuerpo;
        $this->imagen = $noticia->imagen_path;
        $this->portada = $noticia->portada_path;
        $this->fecha_noticia = $noticia->fecha_noticia;
    }

    public function update()
    {
        $noticia_update = Noticia::find($this->id_noticia);

        if ($this->nueva_imagen) {
            $this->validate([
                'nueva_imagen' => 'image|mimes:png,jpg,jpeg|max:8192',
            ], $this->messages);

            Storage::delete($this->imagen);

            $this->imagen = 'storage/' .
                (Storage::disk('public')
                    ->put('imagenes-galeria/noticias', $this->nueva_imagen));

            $this->reset(['nueva_imagen']);
        }

        if ($this->nueva_portada) {
            $this->validate([
                'nueva_portada' => 'image|mimes:png,jpg,jpeg|max:8192',
            ], $this->messages);

            Storage::delete($this->portada);

            $this->portada = 'storage/' .
                (Storage::disk('public')
                    ->put('imagenes-galeria/noticias', $this->nueva_portada));

            $this->reset(['nueva_portada']);
        }

        $this->validate([
            'titulo' => 'required|min:3',
            'sub_titulo' => 'required|min:3',
            'bajada' => 'required|max:5000',
            'cuerpo' => 'required|max:10000',
        ], $this->messages);

        $noticia_update->update([
            'titulo' => $this->titulo,
            'sub_titulo' => $this->sub_titulo,
            'bajada' => $this->bajada,
            'cuerpo' => $this->cuerpo,
            'imagen_path' => $this->imagen,
            'portada_path' => $this->portada,
            'fecha_noticia' => $this->fecha_noticia,
            'user_id' => Auth::user()->id,
        ]);

        // actualizacion de los tags en la noticia
        $noticia_update->tags()->detach();

        foreach ($this->current_tags as $tag_id)
            $noticia_update->tags()->attach($tag_id);

        session()->flash('success', 'Noticia actualizada correctamente!');
        return redirect()->route('admin-noticias');
    }

    public function cancel()
    {
        $this->action = 'admin';

        $this->reset([
            'titulo',
            'sub_titulo',
            'bajada',
            'cuerpo',
            'imagen',
            'portada',
            'fecha_noticia',
        ]);
    }

    public function delete(Noticia $noticia)
    {
        $noticia->delete();
        session()->flash('success', 'Noticia eliminada exitosamente');
        return redirect()->route('admin-noticias');
    }

    public function store()
    {
        $validatedData = $this->validate();
        app('App\Http\Controllers\NoticiaController')->store($validatedData, $this->imagen, $this->portada, $this->current_tags);
    }

    public function addOldTagToNoticia()
    {
        if ($this->current_tag && sizeof($this->current_tags) < 4)

            if (!in_array($this->current_tag, $this->current_tags)) {
                array_push($this->current_tags, $this->current_tag);
                $this->current_tag = '';
            }
    }

    public function removeOldTagToNoticia($id)
    {
        $this->validate([
            'current_tags' => 'array|min:2'
        ], $this->messages);

        unset($this->current_tags[array_search($id, $this->current_tags)]);
        $tags_update = array_values($this->current_tags);
        $this->current_tags = $tags_update;
    }

    public function createTag()
    {
        $this->validate([
            'for_new_tag' => 'max:18'
        ], $this->messages);

        foreach (Tag::all() as $tag)
            if ($this->for_new_tag == $tag->nombre)
                return;

        $new_tag = Tag::create([
            'nombre' => strtolower($this->for_new_tag)
        ]);

        $this->current_tag = $new_tag->id;
        $this->addOldTagToNoticia();
    }

}
