<?php

namespace App\Http\Livewire\Perfil;

use Livewire\Component;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Premio;
use App\Models\Proyecto;
use App\Models\Donacion;
use App\Models\Despacho;
use App\Models\OrdenProyecto;

// por definir si usar
use Livewire\WithPagination;

class InformacionCrowdfunding extends Component
{
    use WithPagination;

    public $id_usuario_actual;
    public $tipo_usuario_actual;

    //atributos filtro
    public $proyectos_por_pagina = 10;
    public $busqueda = '';
    public $ordenar_por = 'id';
    public $orden_ascendente = true;

    // guardado del atributo antiguo para comparacion
    public $proyectos_por_pagina_antiguo = 10;
    public $busqueda_antiguo = '';
    public $ordenar_por_antiguo = 'id';
    public $orden_ascendente_antiguo = true;

    public $estado_botones = [];

    //Usuario actual
    public $usuario;

    public function mount()
    {
		//id usuario
        $this->id_usuario_actual = Auth::user()->id;
        $this->tipo_usuario_actual = Auth::user()->currentTeam->name;

        $this->usuario = User::where('id',$this->id_usuario_actual)->first();

    }

    public function render()
    {

        $proyectos_pendientes = [];
        $proyectos_donados = [];
        $proyectos_ordenes = [];

        $proyectos_artista = [];
		$donaciones = [];
        if($this->tipo_usuario_actual == "Artistas")
        {
            //2.-Se carga un usuario artista
            $proyectos_artista = Proyecto::where('usuario_id', $this->id_usuario_actual)->get();

        }
        elseif($this->tipo_usuario_actual == "Usuarios")
        {
            // Listado de premios de las donaciones
            $id_premios = [];
            $i = 0;
            foreach($this->usuario->donaciones as $donacion)
            {
                $id_premios[$i] = $donacion->premio_id;
                $i++;
            }

            // query que busca la lista de proyectos(se debe revisar cada premio)
            $proyectos_donados = Proyecto::whereHas('premios', function (Builder $query) use ($id_premios){
                $query->whereIn('id',$id_premios);
            })->get();
			$donaciones = Donacion::where('usuario_id',$this->id_usuario_actual)->get();

        }
        elseif($this->tipo_usuario_actual == "Administradores")
        {
            // reset de pagina cuando se cambia un filtro
            if($this->proyectos_por_pagina != $this->proyectos_por_pagina_antiguo ||
                $this->busqueda != $this->busqueda_antiguo ||
                $this->ordenar_por != $this->ordenar_por_antiguo ||
                $this->orden_ascendente != $this->orden_ascendente_antiguo)
            {
                $this->page = 1;
            }

            //actualizacion de valores antiguos
            $this->proyectos_por_pagina_antiguo = $this->proyectos_por_pagina;
            $this->busqueda_antiguo = $this->busqueda;
            $this->ordenar_por_antiguo = $this->ordenar_por;
            $this->orden_ascendente_antiguo = $this->orden_ascendente;

            $proyectos_pendientes = Proyecto::buscar($this->busqueda)
            ->where('aprobado','PENDIENTE')
            ->orderBy($this->ordenar_por, $this->orden_ascendente ? 'asc':'desc')
            ->simplePaginate($this->proyectos_por_pagina);
        }

        $i = 0;
        foreach($proyectos_donados as $proyecto){
            $this->estado_botones[] = false;
            $proyectos_ordenes[$i] = OrdenProyecto::where('proyecto_id',$proyecto->id)
                                                    ->where('usuario_id',$this->id_usuario_actual)
                                                    ->first();
            $i++;

        }

        return view('livewire.perfil.informacion-crowdfunding',[
            'proyectos_pendientes' => $proyectos_pendientes,
            'proyectos_donados'    => $proyectos_donados,
            'proyectos_artista'    => $proyectos_artista,
            'proyectos_ordenes'    => $proyectos_ordenes,
            'donaciones'           => $donaciones,
        ]);

    }

    public function mostrarOcultarPremios($index)
    {
        $this->estado_botones[$index] = !$this->estado_botones[$index];
    }

}
