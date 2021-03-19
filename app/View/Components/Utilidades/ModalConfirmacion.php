<?php

namespace App\View\Components\Utilidades;

use Illuminate\View\Component;

class ModalConfirmacion extends Component
{

    public $id; // Id del <div> del modal.
    public $titulo;
    public $tema; // Tema del modal. Define el título del botón.
    public $estilosBoton;
    public $clasesBoton; // Clases para el botón que abre el modal.
    public $colorBg; // Color de fondo del botón que confirma la acción.
    public $colorBgHover; // Color de fondo cuando se está sobre el botón que confirma la acción.
    public $colorTexto; // Color utilizado para el icono.
    public $colorBordeIcono;
    public $tipoIcono; // Nombre del material icon que se quiere usar.
    public $form; // Indica si el botón está dentro de un form o no.
    public $rutaHref; // En caso de que el botón no active un form, se manda una ruta para el href de la etiqueta <a>.
    public $idParamRuta; // Parámetro que recibirá la ruta.

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $titulo, $tema, $estilosBoton, $clasesBoton, $colorBg, $colorBgHover, $colorTexto, $colorBordeIcono, $tipoIcono, $form, $rutaHref, $idParamRuta)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->tema = $tema;
        $this->estilosBoton = $estilosBoton;
        $this->clasesBoton = $clasesBoton;
        $this->colorBg = $colorBg;
        $this->colorBgHover = $colorBgHover;
        $this->colorTexto = $colorTexto;
        $this->colorBordeIcono = $colorBordeIcono;
        $this->tipoIcono = $tipoIcono;
        $this->form = $form;
        $this->rutaHref = $rutaHref;
        $this->idParamRuta = $idParamRuta;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.utilidades.modal-confirmacion');
    }
}
