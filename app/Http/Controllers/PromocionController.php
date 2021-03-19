<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Promocion;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('market.create-promocion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(array $data, $portada, $banner)
    {
        $una_promo = Promocion::create([
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'imagen_path' => 'storage/' . (Storage::disk('public')->put('imagenes-galeria/noticias', $portada)),
            'banner_path' => 'storage/' . (Storage::disk('public')->put('imagenes-galeria/noticias', $banner)),
            'bloque' => $data['seccion_index'],
        ]);

        session()->flash('success', 'Promoción creada correctamente');
        return redirect()->route('index-market');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id, $orden = null)
    {
        $promocion = Promocion::find($id);
        $productos = $promocion->productos()->orderBy('vendidos')->get();

        if ($orden == 'Alfabetico')
            $productos = $promocion->productos()->orderBy('nombre')->get();
        elseif ($orden == 'Novedades')
            $productos = $promocion->productos()->orderBy('created_at')->get();
        elseif ($orden == 'Precio de menor a mayor')
            $productos = $promocion->productos()->orderBy('precio')->get();
        elseif ($orden == 'Precio de mayor a menor')
            $productos = $promocion->productos()->orderBy('precio', 'DESC')->get();

        // inicio - manejo de recomendados
        $listaTemas = [];
        foreach ($productos as $producto)
            array_push($listaTemas, $producto->tema->nombre);

        $listaRecmendados = [];
        foreach ($listaTemas as $listaTema) {
            if (sizeof($listaRecmendados) >= 6) break;

            foreach (Producto::all()->where('tema_id', '=', Tema::all()->where('nombre', '=', $listaTema)->first()->id) as $prod_rec)
                array_push($listaRecmendados, $prod_rec);
        }

        $final_recom = [];
        foreach ($listaRecmendados as $recs) {
            if (sizeof($final_recom) == 6) break;
            array_push($final_recom, $recs);
        }
        // fin - manejo de recomendados

        $ordenarPor = [
            'Alfabetico',
            'Novedades',
            'Precio de menor a mayor',
            'Precio de mayor a menor',
            'Recomendados',
        ];

        return view('market.ver-promocion', [
            'promocion' => $promocion,
            'productos_all' => $productos,
            'ordenamientos' => $ordenarPor,
            'tema_recomen' => $final_recom
        ]);
    }


    public function admin()
    {
        return view('market.admin-promocion');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('market.edit-promocion', [
            'id_promo' => $id
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
