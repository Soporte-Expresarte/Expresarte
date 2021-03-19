<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Perfil\VistaPerfil;
use App\Models\Donacion;
use App\Models\ImagenProyecto;
use App\Models\Premio;
use App\Models\Proyecto;
use App\Models\OrdenProyecto;
use App\Models\Despacho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use DateTime;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $proyectos = Proyecto::orderBy('id', 'DESC')
            ->where('aprobado', 'SI')
            ->where('estado', 'EN CURSO')
            ->get();

        $proyectos_novedosos = Proyecto::orderBy('fecha_inicio', 'DESC')
            ->where('aprobado', 'SI')
            ->where('estado', 'EN CURSO')
            ->limit(3)
            ->get();

        $proyectos_populares = Proyecto::orderBy('contador_visitas', 'DESC')
            ->where('aprobado', 'SI')
            ->limit(6)
            ->get();

        // revisar biene este
        $proyectos_ultima_semana = Proyecto::orderBy('fecha_limite', 'DESC')
            ->where('aprobado', 'SI')
            ->where('estado', 'EN CURSO')
            ->where('duracion_dias', '<', 7)
            ->limit(3)
            ->get();

        $proyectos_pasados = Proyecto::orderBy('fecha_limite', 'DESC')
            ->where('aprobado', 'SI')
            ->where('estado', 'FINALIZADO')
            ->limit(6)
            ->get();

        $proyectos_sobre_limite = Proyecto::all()
            ->where('monto_actual', '>', 'meta')
            ->sortByDesc('monto_actual')
            ->take(5);

        $los_proy = [];
        $cont = 0;
        foreach (Proyecto::orderBy('monto_actual')->where('aprobado', 'SI')->where('estado', 'EN CURSO')->get() as $proy) {
            if ($proy->meta > $proy->monto_actual) {
                array_push($los_proy, $proy);
                $cont++;
            }
            if ($cont >= 6) break;
        }
        $proyectos_menos_financiamiento = $los_proy;

        $proyectos_inpulso_cohete = [];
        //if (now()->diff($proy->fecha_inicio)->days <= 14) {
        foreach (Proyecto::all() as $proy) {
            if ($proy->aprobado == 'SI') {
                if ($proy->monto_actual > $proy->meta) {
                    array_push($proyectos_inpulso_cohete, $proy);
                }
            }
        }
        //dd($proyectos_inpulso_cohete);

        return view('crowdfunding.index-crowdfunding', [
            'proyectos' => $proyectos,
            'proyectos_novedosos' => $proyectos_novedosos,
            'proyectos_populares' => $proyectos_populares,
            'proyectos_ultima_semana' => $proyectos_ultima_semana,
            'proyectos_pasados' => $proyectos_pasados,
            'proyectos_sobre_limite' => $proyectos_sobre_limite,
            'proyectos_menos_financiamiento' => $proyectos_menos_financiamiento,
            'proyectos_inpulso_cohete' => $proyectos_inpulso_cohete
        ]);
    }

    public function indexPorClasificacion($clasificacion)
    {
        $los_proyectos = Proyecto::all();

        if ($clasificacion == 'todos-activos-novedad') {
            $los_proyectos = Proyecto::orderBy('fecha_inicio', 'DESC')
                ->where('aprobado', 'SI')
                ->where('estado', 'EN CURSO')
                ->get();

        } elseif ($clasificacion == 'todos-orden-visitas') {
            $los_proyectos = Proyecto::orderBy('contador_visitas', 'DESC')
                ->where('aprobado', 'SI')
                ->get();

        } elseif ($clasificacion == 'todos-orden-menos-apoyo') {
            $los_proy = [];

            foreach (Proyecto::orderBy('monto_actual')->where('aprobado', 'SI')->where('estado', 'EN CURSO')->get() as $proy)
                if ($proy->meta > $proy->monto_actual)
                    array_push($los_proy, $proy);
            $los_proyectos = $los_proy;

        } elseif ($clasificacion == 'todos-finalizados') {
            $los_proyectos = Proyecto::orderBy('fecha_limite', 'DESC')
                ->where('aprobado', 'SI')
                ->where('estado', 'FINALIZADO')
                ->get();

        } elseif ($clasificacion == 'todos-activos') {
            $los_proyectos = Proyecto::orderBy('fecha_limite', 'DESC')
                ->where('aprobado', 'SI')
                ->where('estado', 'EN CURSO')
                ->get();
        }

        return view('crowdfunding.index-proyecto-clasificacion', [
            'los_proyectos' => $los_proyectos,
            'clasificacion' => $clasificacion
        ]);
    }

    public function crearProyecto()
    {
        return view('crowdfunding.crear-proyecto');
    }


    /**
     * Inserta el proyecto a la tabla Proyectos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(array $infoValidada, array $imagenes, array $premios)
    {
        //Se guarda el proyecto en la base de datos
        $proyectoCreado = Proyecto::create($infoValidada);

        //se cambia la url del video a un embed
        $url = $proyectoCreado->url_video;

        // se elimina el contenido desde el primer '&'
        $i = stripos($url, "&");
        if ($i !== false) {
            $url = substr($url, 0, $i);
        }

        // se cambia watch?v= por embed/
        $regex_remplazado = "/watch\?v\=/";
        $url_final = preg_replace($regex_remplazado, "embed/", $url);

        $proyectoCreado->update(['url_video' => $url_final]);

        //Creacion imagenes
        for ($i = 0; $i < count($imagenes); $i++) {
            $imagen = $imagenes[$i];
            $rutaImagen = Storage::disk('public')->put('crowdfunding', $imagen);
            //dd($nombreImagen);
            $dataImagen = array('ruta' => 'storage/' . $rutaImagen,
                'proyecto_id' => $proyectoCreado->id);

            // Insertamos las imagenes en la BD
            ImagenProyecto::create($dataImagen);
        }

        //Creacion premios
        if ($premios)
            foreach ($premios as $p) {
                $premio = array('nombre' => $p['nombre'],
                    'descripcion' => $p['descripcion'],
                    'precio_minimo' => $p['precio_minimo'],
                    'cantidad_actual' => $p['cantidad_maxima'],
                    'cantidad_maxima' => $p['cantidad_maxima'],
                    'proyecto_id' => $proyectoCreado->id,
                );
                Premio::create($premio);
            }

        session()->flash('success', 'Proyecto creado exitosamente !');
        return redirect()->route('index-crowdfunding');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Proyecto $proyecto
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {

        $proyecto = Proyecto::where('id', $id)->first();

        $proyecto->contador_visitas++;
        $proyecto->save();

        // se crea lista con los id de premios para facilitar la query
        $id_premios = [];
        $i = 0;
        foreach ($proyecto->premios as $premio) {
            $id_premios[$i] = $premio->id;
            $i++;
        }

        // query que busca la lista de colaboradores(se debe revisar cada premio)
        $colaboradores = User::whereHas('donaciones', function (Builder $query) use ($id_premios) {
            $query->whereIn('premio_id', $id_premios);
        })->get();

        if ($proyecto->aprobado != "SI") {
            if (!Auth::check()) {
                return redirect()->route('index-crowdfunding');
            }

            $usuario = Auth::user();
            if ($usuario->currentTeam->name != "Administradores" && $usuario->id != $proyecto->publicador->id) {
                return redirect()->route('index-crowdfunding');
            }
        }

        $ordenes = OrdenProyecto::where('proyecto_id', $id)->get();
        $monto_actual = $proyecto->monto_actual;
        foreach ($ordenes as $orden) {
            $monto_actual += $orden->monto_pagado;
        }

        $proyecto->monto_actual = $monto_actual;
        $proyecto->save();

        // verificar si el dueño de este proyecto tiene mas proyectos
        $sumador = 0;
        $tiene_mas_proy = 'NO';
        foreach (Proyecto::all() as $proy) {
            if ($proy->publicador->id == $proyecto->publicador->id)
                $sumador++;
            if ($sumador > 1) {
                $tiene_mas_proy = 'SI';
                break;
            }
        }

        // mas proyectos del artista
        $los_relacionados = [];
        $contador = 0;
        if ($tiene_mas_proy == 'SI') {

            foreach (Proyecto::all()->where('aprobado', '=', 'SI') as $one_proy) {
                if ($proyecto->publicador->id == $one_proy->publicador->id) {
                    array_push($los_relacionados, $one_proy);
                    $contador++;
                }
                if ($contador >= 6) break;
            }
        } else {

            foreach (Proyecto::orderBy('monto_actual')->where('aprobado', 'SI')->where('estado', 'EN CURSO')->get() as $proy) {
                if ($proy->meta > $proy->monto_actual) {
                    array_push($los_relacionados, $proy);
                    $contador++;
                }
                if ($contador >= 6) break;
            }
        }

        // verificar si el proeyecto le pertenece al usuario que ve el proyecto
        $es_dueno = 'NO';
        if ($proyecto->publicador->id == Auth::id())
            $es_dueno = 'SI';


        return view('crowdfunding.ver-proyecto', [
            'proyecto' => $proyecto,
            'colaboradores' => $colaboradores,
            'tiene_mas_proy' => $tiene_mas_proy,
            'los_relacionados' => $los_relacionados,
            'es_dueno' => $proyecto->publicador->id == Auth::id() ? 'SI' : 'NO',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Proyecto $proyecto
     * @return \Illuminate\Http\Response
     */
    public function showAdmin($id)
    {
        $proyecto = Proyecto::where('id', $id)->first();
        if ($proyecto->aprobado != "PENDIENTE") {
            return redirect()->route('index-crowdfunding');
        }
        return view('crowdfunding.ver-proyecto-admin', [
            'proyecto' => $proyecto
        ]);
    }

    public function edit($id)
    {
        return view('crowdfunding.editar-proyecto', [
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Proyecto $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        // Update
        $proyecto->fill($request->all());

        $proyecto->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Proyecto $proyecto
     * @return \Illuminate\Http\Response
     */
    public function cancel(Proyecto $proyecto)
    {
        $proyecto->update([
            'estado' => 'CANCELADO',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Proyecto $proyecto
     * @return \Illuminate\Http\Response
     */
    public function finalized(Proyecto $proyecto)
    {
        $proyecto->update(['estado' => 'FINALIZADO']);
    }

    public function listadoProyectos()
    {
        return view('crowdfunding.listado-proyectos');
    }

    /**
     * Update a project to approve it
     * @param Proyecto $proyecto
     */
    public function aprobar($id)
    {
        $proyecto = Proyecto::where('id', $id)->first();

        //dd($proyecto);

        $fecha_inicial = new DateTime('now');
        $fecha_limite = clone $fecha_inicial;
        $fecha_limite->modify('+' . $proyecto->duracion_dias . ' day');

        $proyecto->fecha_inicio = $fecha_inicial;
        $proyecto->fecha_limite = $fecha_limite;
        $proyecto->aprobado = 'SI';
        $proyecto->estado = 'EN CURSO';
        $proyecto->save();

        // se crea lista con los id de premios para facilitar la query
        $id_premios = [];
        $i = 0;
        foreach ($proyecto->premios as $premio) {
            $id_premios[$i] = $premio->id;
            $i++;
        }

        // query que busca la lista de colaboradores(se debe revisar cada premio)
        $colaboradores = User::whereHas('donaciones', function (Builder $query) use ($id_premios) {
            $query->whereIn('premio_id', $id_premios);
        })->get();

        return redirect()->route('mostrar-proyecto', ['id' => $proyecto->id]);
    }

    /**
     * Update project to not approve it
     * @param Proyecto $proyecto
     */
    public function rechazar($id)
    {
        $proyecto = Proyecto::where('id', $id)->first();

        $proyecto->update(['aprobado' => 'NO']);

        return redirect()->route('vista-perfil');
    }

    public function escogerPremios($id)
    {
        $proyecto = Proyecto::where('id', $id)->first();

        $orden = OrdenProyecto::where('proyecto_id', $proyecto->id)
            ->where('usuario_id', Auth::user()->id)
            ->first();

        $despacho = null;
        if ($orden != null) {
            $despacho = $orden->despacho;
        }

        return view('crowdfunding.escoger-premios', [
            'proyecto' => $proyecto,
            'despacho' => $despacho,
        ]);
    }

    public function crearOrden(array $datos, array $cantidades_premios)
    {
        $usuario = Auth::user();
        $proyecto = $datos['proyecto'];

        $orden = OrdenProyecto::where('proyecto_id', $proyecto->id)
            ->where('usuario_id', Auth::user()->id)
            ->first();

        if ($orden != null) {
            //la orden ya existe, asique debemos actualizarla
            $orden->monto_total += $datos['donacion_total'];

            //actualizacion del despacho
            $despacho = $orden->despacho;
            $despacho->calle = $datos['calle'];
            $despacho->numero_hogar = $datos['numero_hogar'];
            $despacho->comuna = $datos['comuna'];
            $despacho->region = $datos['region'];
            $despacho->pais = $datos['pais'];

            //actualizar los premios del usuario
            for ($i = 0; $i < count($proyecto->premios); $i++) {
                if ($cantidades_premios[$i] > 0) {

                    $donacion = Donacion::where('usuario_id', $usuario->id)->where('premio_id', $proyecto->premios[$i]->id)->first();

                    // si ya ha comprado ese premio antes, actualizamos
                    if ($donacion != null) {
                        $donacion->cantidad += $cantidades_premios[$i];
                        $donacion->monto_donado += $cantidades_premios[$i] * $proyecto->premios[$i]->precio_minimo;
                        $donacion->save();
                    } else {
                        Donacion::create([
                            'cantidad' => $cantidades_premios[$i],
                            'monto_donado' => $cantidades_premios[$i] * $proyecto->premios[$i]->precio_minimo,
                            'usuario_id' => $usuario->id,
                            'premio_id' => $proyecto->premios[$i]->id,
                            'orden_id' => $orden->id,
                        ]);
                    }
                }
            }

            $orden->save();
            $despacho->save();
        } else {
            //la orden no existe, asique debemos crearla junto con su despacho
            $despacho = Despacho::create([
                'calle' => $datos['calle'],
                'numero_hogar' => $datos['numero_hogar'],
                'comuna' => $datos['comuna'],
                'region' => $datos['region'],
                'pais' => $datos['pais'],
                'celular' => $datos['celular'],
                'nombre' => $usuario->name,
                'apellido' => $usuario->apellido,
            ]);

            $orden = OrdenProyecto::create([
                'monto_total' => $datos['donacion_total'],
                'proyecto_id' => $proyecto->id,
                'usuario_id' => $usuario->id,
                'despacho_id' => $despacho->id,
            ]);

            //actualizar los premios del usuario

            for ($i = 0; $i < count($proyecto->premios); $i++) {
                if ($cantidades_premios[$i] > 0) {
                    Donacion::create([
                        'cantidad' => $cantidades_premios[$i],
                        'monto_donado' => $cantidades_premios[$i] * $proyecto->premios[$i]->precio_minimo,
                        'usuario_id' => $usuario->id,
                        'premio_id' => $proyecto->premios[$i]->id,
                        'orden_id' => $orden->id,
                    ]);
                }
            }
        }

        //actualizamos la cantidad de premios del proyecto
        for ($i = 0; $i < count($proyecto->premios); $i++) {
            $proyecto->premios[$i]->cantidad_actual -= $cantidades_premios[$i];
            $proyecto->premios[$i]->save();
        }

        return redirect()->route('mostrar-proyecto', ['id' => $proyecto->id]);
    }
}
