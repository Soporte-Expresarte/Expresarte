<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //$eventos = DB::SELECT("SELECT * FROM `eventos` WHERE (SELECT DATE_ADD(`fecha_evento`, INTERVAL `duracion` MINUTE)) > now() AND estado = 'APROBADO' ORDER BY `fecha_evento` ASC");

        $eventos_proximos = Evento::all()->where('estado', '=', 'APROBADO')
            ->where('fecha_evento', '>', now())
            ->sortBy('fecha_evento');

        $eventos_actuales = Evento::all()->where('estado', '=', 'APROBADO')
            ->where('fecha_evento', '<', now())
            ->where('fecha_termino', '>', now())
            ->sortBy('fecha_evento');

        $eventos_pasados = Evento::all()->where('estado', '=', 'APROBADO')
            ->where('fecha_evento', '<', now())
            ->where('fecha_termino', '<', now())
            ->sortByDesc('fecha_evento');

        //$eventos_actuales = DB::SELECT("SELECT * FROM `eventos` WHERE (SELECT DATE_ADD(`fecha_evento`, INTERVAL `duracion` MINUTE)) > now() AND `fecha_evento` < now() AND estado = 'APROBADO' ORDER BY `fecha_evento` DESC");

        return view('galeria.eventos.index-eventos', [
            'eventos' => $eventos_proximos,
            'eventos_pasados' => $eventos_pasados,
            'eventos_actuales' => $eventos_actuales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galeria.eventos.crear-evento');
    }

    public function actualizar(array $data, Evento $evento)
    {

        $foto_evento_antigua = $evento->foto_evento;
        $foto_portada_antigua = $evento->foto_portada;
        $evento->fill($data)->save();

        if ($data['foto_evento'] != null) { //Imagen nueva
            $imagen_evento = 'storage/' . (Storage::disk('public')->put('imagenes-galeria/eventos', $data['foto_evento']));
            $evento->foto_evento = $imagen_evento;
        } else {
            $evento->foto_evento = $foto_evento_antigua;
        }

        if ($data['foto_portada'] != null) { //Imagen nueva
            $imagen_portada = 'storage/' . (Storage::disk('public')->put('imagenes-galeria/eventos', $data['foto_portada']));
            $evento->foto_portada = $imagen_portada;
        } else {
            $evento->foto_portada = $foto_portada_antigua;
        }

        //FIXME: Borrar las imagenes del disco

        $evento->save();

        session()->flash('success', 'Evento editado satisfactoriamente.');
        return redirect()->route('admin-eventos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(array $data)
    {
        //$fechaInicio = new \DateTime($data['fecha_inicio']);
        //$fechaTermino = new \DateTime($data['fecha_termino']);

        //$dif = ($fechaTermino->diff($fechaInicio));

        //Convierte la diferencia a minutos
        //$duracion = ($dif->y * 525600) + ($dif->m * 43800) + ($dif->d * 1440) + ($dif->h * 60) + ($dif->i);

        $estadoAprobado = 'APROBADO';

        if (Auth::user()->currentTeam->name == "Artistas")
            $estadoAprobado = 'PENDIENTE';

        Evento::create([
            'titulo' => $data['titulo'],
            'fecha_evento' => $data['fecha_inicio'],
            'fecha_termino' => $data['fecha_termino'],
            'lugar' => $data['lugar'],
            'descripcion' => $data['descripcion'],
            'foto_portada' => 'storage/' . (Storage::disk('public')->put('imagenes-galeria/eventos', $data['foto_portada'])),
            'foto_evento' => 'storage/' . (Storage::disk('public')->put('imagenes-galeria/eventos', $data['foto_evento'])),
            'usuario_id' => Auth::user()->id,
            'estado' => $estadoAprobado,
        ]);

        (Auth::user()->currentTeam->name == "Artistas") ?
            session()->flash('success', 'Tendrá que esperar hasta que el administrador apruebe su solicitud.') :
            session()->flash('success', 'Evento creado satisfactoriamente.');


        return redirect()->route('index-eventos');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function show($id)
    {
        $evento = Evento::where('id', '=', $id)->first();

        return view('galeria.eventos.show-evento', [
            'evento' => $evento,
        ]);
    }

    /**
     * @param $orden
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPorPeriodo($orden)
    {
        $eventos = '';
        if ($orden == 'actualmente-vigentes')
            $eventos = Evento::all()->where('estado', '=', 'APROBADO')
                ->where('fecha_evento', '<', now())
                ->where('fecha_termino', '>', now())
                ->sortBy('fecha_evento');

        elseif ($orden == 'por-venir')
            $eventos = Evento::all()->where('estado', '=', 'APROBADO')
                ->where('fecha_evento', '>', now())
                ->sortBy('fecha_evento');

        elseif ($orden == 'finalizados')
            $eventos = Evento::all()->where('estado', '=', 'APROBADO')
                ->where('fecha_evento', '<', now())
                ->where('fecha_termino', '<', now())
                ->sortByDesc('fecha_evento');
        else
            $eventos = Evento::all();

        return view('galeria.eventos.show-por-periodo', [
            'eventos' => $eventos,
            'orden' => $orden
        ]);
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function busqueda()
    {
        $textobusqueda = $_GET['texto'];

        return view('galeria.eventos.index-buscados', [
            'eventos' => Evento::query()
                ->where('titulo', 'LIKE', "%{$textobusqueda}%")
                //->orWhere('descripcion', 'LIKE', "%{$textobusqueda}%")
                //->orWhere('lugar', 'LIKE', "%{$textobusqueda}%")
                ->orderBy('fecha_evento', 'desc')
                ->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        return view('galeria.artistas.index-artistas');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function eliminar($id)
    {

        Evento::find($id)->delete();
        session()->flash('success', 'Evento eliminado satisfactoriamente.');
        return redirect()->route('admin-eventos');
    }

    public
    function editar(Evento $evento)
    {

        return view('galeria.eventos.editar-evento', ['evento' => $evento]);
    }

    public
    function adminEventos()
    {

        $eventos = Evento::all()->where('estado', 'APROBADO')->sortDesc();
        return view('galeria.eventos.admin-eventos', ['eventos' => $eventos]);
    }

    public
    function aprobado(Evento $evento)
    {
        $evento->update([
            'estado' => 'APROBADO',
        ]);

        session()->flash('success', 'Evento aprobado exitosamente.');
        return view('livewire.perfil.galeria.admin.aprobar-eventos');
    }

    public
    function rechazado(Evento $evento)
    {
        $evento->update([
            'estado' => 'RECHAZADO',
        ]);

        session()->flash('success', 'Evento rechazado exitosamente.');
        return view('livewire.perfil.galeria.admin.aprobar-eventos');
    }

}
