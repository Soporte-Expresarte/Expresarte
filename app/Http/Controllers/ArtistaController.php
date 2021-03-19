<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class ArtistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $idArtista = Team::where('name', '=', 'Artistas')->first()->id;

        return view('galeria.artistas.index-artistas', [
            'artistas' => User::where('current_team_id', '=', $idArtista)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($apodo)
    {
        $artista = User::where('apodo', '=', $apodo)->first();

        $obras = Obra::all()
            ->where('usuario_id', '=', $artista->id)
            ->where('estado', '=', 'APROBADO');

        $estilos = [];
        foreach ($obras as $obra)
            array_push($estilos, $obra->tipo);

        $estilos = array_unique($estilos);

        return view('galeria.artistas.show-artista', [
            'artista' => $artista,
            'obras' => $obras,
            'estilos' => $estilos
        ]);
    }

    public function busqueda()
    {
        $textobusqueda = $_GET['texto'];
        return view('galeria.artistas.index-artistas', [
            'artistas' => User::query()
                ->where('name', 'LIKE', "%{$textobusqueda}%")
                ->orWhere('apellido', 'LIKE', "%{$textobusqueda}%")
                //->orWhere('apodo', 'LIKE', "%{$textobusqueda}%")
                ->get()
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
