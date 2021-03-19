<?php

namespace App\Http\Controllers;

use App\Models\ImagenObra;
use App\Models\Obra;
use App\Models\Team;
use App\Models\TipoObra;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('galeria.obras.index-exposiciones', [
            'obras' => Obra::orderBy('created_at', 'desc')->where('estado', '=', 'APROBADO')->paginate(12),
        ]);
    }

    /**
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminObras()
    {
        return view('galeria.obras.admin-obras', [
            'action' => 'admin'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('galeria.obras.create-obra', [
            'action' => 'create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function store(array $data, array $imagenes)
    {
        $estadoAprobado = 'APROBADO';

        if (Auth::user()->currentTeam->name == "Artistas") {
            $estadoAprobado = 'PENDIENTE';
        }

        // creacion del modelo Obra con los datos recibidos
        $obra = Obra::create([
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'tipo' => TipoObra::find($data['tipo'])->nombre,
            'especificaciones' => $data['especificaciones'],
            'usuario_id' => Auth::user()->id,
            'tipo_obra_id' => $data['tipo'],
            'estado' => $estadoAprobado,
        ]);

        //Creacion imagenes
        foreach ($imagenes as $imagen_ind) {
            //$nombreImagen = time() . "_" . $imagenes[$i]->getClientOriginalName();
            $rutaImagen = 'storage/' .
                (Storage::disk('public')
                    ->put('imagenes-galeria/obras', $imagen_ind));

            // Inseryat las imagenes en la DB
            ImagenObra::create([
                'ruta' => $rutaImagen,
                'obra_id' => $obra->id,
            ])->save();
        }

        (Auth::user()->currentTeam->name == "Artistas") ?
            session()->flash('success', 'Obra creada, ahora el administrador debe aprobar la publicación') :
            session()->flash('success', 'Obra creada correctamente.');

        return redirect()->route('index-exposiciones');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Obra $obra)
    {
        $idTeamAdmin = Team::where('name', '=', 'Administradores')->first()->id;

        $usuario = User::find($obra->usuario->id);

        $obras = Obra::orderBy('created_at', 'desc')->where('estado', '=', 'APROBADO')->where('usuario_id', '=', $usuario->id)->get();

        return view('galeria.obras.show-obra', [
            'obra' => $obra,
            'obras' => $obras,
            'id_admin' => $idTeamAdmin,
        ]);
    }

    public function busqueda()
    {
        $textobusqueda = $_GET['texto'];

        return view('galeria.obras.index-buscados', [
            'obras' => Obra::query()
                //->where('estado', 'LIKE', 'APROBADO')
                ->where('titulo', 'LIKE', "%{$textobusqueda}%")
                ->orderBy('created_at')
                //->orWhere('descripcion', 'LIKE', "%{$textobusqueda}%")
                //->orWhere('tipo', 'LIKE', "%{$textobusqueda}%")
                ->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Obra $obra)
    {
        //app('App\Http\Livewire\Galeria\FormCreateObra')->edit($obra);
        return view('galeria.obras.edit-obra', [
            'editMode' => true,
            'obra' => $obra,
            'tipos' => TipoObra::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Obra $obra)
    {

        $elTipo = TipoObra::find(\request('tipo'));
        $idObra = $obra->id;
        $imagenesBD = ImagenObra::all()->where('obra_id', $idObra);

        $obra->update([
            'titulo' => \request('titulo'),
            'descripcion' => \request('descripcion'),
            'tipo' => $elTipo->nombre,
            'especificaciones' => \request('especificaciones'),
            'usuario_id' => $obra->usuario_id,
            'tipo_obra_id' => \request('tipo')
        ]);

        $imagenes[] = \request('imagenes');

        if (!empty($imagenes)) {
            foreach ($imagenesBD as $img) {
                ImagenObra::destroy($img->id);
            }
            //Creacion imagenes
            for ($i = 0; $i < count($imagenes); $i++) {
                //$nombreImagen = time() . "_" . $imagenes[$i]->getClientOriginalName();

                $rutaImagen = Storage::disk('public')->put('imagenes-galeria/obras', $imagenes[$i]);

                // Inseryat las imagenes en la DB
                ImagenObra::create([
                    'ruta' => 'storage/' . $rutaImagen,
                    'obra_id' => $obra->id,
                ]);
            }
        }


        session()->flash('success', 'Obra actualizada correctamente');
        return redirect()->route('admin-obras');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obra $obra)
    {
        $imagenesBD = ImagenObra::all()->where('obra_id', $obra->id);
        foreach ($imagenesBD as $imagen_obra) {
            $imagen_obra->delete();
        }

        $obra->delete();
        session()->flash('success', 'Obra eliminada correctamente');
        return redirect()->route('admin-obras');
    }

    public function aprobado(Obra $obra)
    {
        $obra->update([
            'estado' => 'APROBADO',
        ]);

        session()->flash('success', 'Obra aprobada exitosamente.');
        return view('livewire.perfil.galeria.admin.aprobar-obras');
    }

    public function rechazado(Obra $obra)
    {
        $obra->update([
            'estado' => 'RECHAZADO',
        ]);

        session()->flash('success', 'Obra rechazada exitosamente.');
        return view('livewire.perfil.galeria.admin.aprobar-obras');
    }
}
