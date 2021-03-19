<?php

namespace App\Http\Controllers;

use App\Models\Exposicion;
use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $exposiciones = Exposicion::orderBy('created_at', 'DESC')->paginate(10);

        return view('galeria.exposiciones.index-expo', [
            'exposiciones' => $exposiciones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('galeria.exposiciones.create-expo');
    }

    public function admin()
    {
        return view('galeria.exposiciones.admin-expo');
    }

    public function buscarPorTipo($tipo)
    {
        return view('galeria.obras.index-buscados', [
            'obras' => Obra::all()->where('tipo', '=', $tipo)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(array $data, $obrasElegidas)
    {
        $la_expo = Exposicion::create([
            'titulo' => $data['titulo'],
            'sub_titulo' => $data['sub_titulo'],
            'descripcion' => $data['descripcion'],
            'usuario_id' => Auth::id()
        ]);

        foreach ($obrasElegidas as $the_obra)
            $la_expo->obras()->attach($the_obra);

        session()->flash('success', 'Exposición creada correctamente');
        return redirect()->route('index-expo');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $exposicion = Exposicion::find($id);

        $tipo_obras = [];
        foreach ($exposicion->obras as $obra)
            array_push($tipo_obras, $obra->tipo);
        $tipo_obras = array_unique($tipo_obras);

        return view('galeria.exposiciones.show-expo', [
            'exposicion' => $exposicion,
            'tipos_obra' => $tipo_obras
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('galeria.exposiciones.edit-expo', [
            'id' => $id
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
