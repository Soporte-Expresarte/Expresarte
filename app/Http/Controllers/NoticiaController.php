<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::orderBy('fecha_noticia', 'desc')->paginate(12);

        return view('galeria.noticias.index-noticias', [
            'noticias' => $noticias,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminNoticias()
    {
        return view('galeria.noticias.admin-noticias', [
            'action' => 'admin'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('galeria.noticias.create-noticia', [
            'action' => 'create'
        ]);
    }

    public function busqueda()
    {
        $textobusqueda = $_GET['texto'];

        return view('galeria.noticias.index-buscados', [
            'noticias' => Noticia::query()
                ->where('titulo', 'LIKE', "%{$textobusqueda}%")
                //->orWhere('descripcion', 'LIKE', "%{$textobusqueda}%")
                //->orWhere('lugar', 'LIKE', "%{$textobusqueda}%")
                ->orderByDesc('fecha_noticia')
                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(array $data, $imagen, $portada, $clicked_tags)
    {
        $noticia = Noticia::create([
            'titulo' => $data['titulo'],
            'sub_titulo' => $data['sub_titulo'],
            'bajada' => $data['bajada'],
            'cuerpo' => $data['cuerpo'],
            'imagen_path' => 'storage/' . (Storage::disk('public')->put('imagenes-galeria/noticias', $imagen)),
            'portada_path' => 'storage/' . (Storage::disk('public')->put('imagenes-galeria/noticias', $portada)),
            'fecha_noticia' => date(now()),
            'usuario_id' => Auth::id()
        ]);

        foreach ($clicked_tags as $tag_id)
            $noticia->tags()->attach($tag_id);

        session()->flash('success', 'Noticia creada correctamente');
        return redirect()->route('index-noticias');
    }

    /**
     * Display the specified resource.
     *
     * @param Noticia $noticia
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $la_noticia = Noticia::find($id);
        $autor = User::find($la_noticia->usuario_id);
        $actualTags = $la_noticia->tags;

        // buscando id de noticias relacinoadas
        $relacionados = [];
        foreach ($actualTags as $tag)
            foreach ($tag->noticias as $noticia)
                if ($id != $noticia->id)
                    array_push($relacionados, $noticia->id);

        // reduciendo id repetidos
        $relacionados = array_unique($relacionados);

        if (sizeof($relacionados) < 6) {

            foreach (Noticia::all() as $noticia) {
                if (sizeof($relacionados) > 10) break;
                array_push($relacionados, $noticia->id);
            }
            $relacionados = array_unique($relacionados);
        }


        // obteniendo las noticias relacionadas sin repetir y a maximo 6
        $noticiasRelacionadas = [];
        $cantMax = 0;
        foreach ($relacionados as $relacionado) {

            if ($cantMax == 6) break;

            array_push($noticiasRelacionadas, Noticia::find($relacionado));
            $cantMax++;
        }


        return view('galeria.noticias.show-noticia', [
            'noticia' => $la_noticia,
            'autor' => $autor,
            'relacionados' => $noticiasRelacionadas
        ]);
    }

    /**
     * devolver noticias para algun tag
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show_by_tag($id)
    {
        $tag_principal = Tag::find($id);
        $noticias = $tag_principal->noticias()->get();

        return view('galeria.noticias.show-by-tag', [
            'tag_principal' => $tag_principal,
            'noticias' => $noticias
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view('galeria.noticias.create-noticia', [
            'action' => 'delete'
        ]);
    }
}
