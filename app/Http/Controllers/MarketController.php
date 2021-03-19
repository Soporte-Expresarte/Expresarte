<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Promocion;
use App\Models\Tema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Despacho;
use App\Models\Orden;

class MarketController extends Controller
{
    /**
     *  Redirige a la vista principal del market.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $productosMasNuevos = Producto::all()->sortByDesc('created_at')->take(8);
        $productosMasVendidos = Producto::all()->sortByDesc('vendidos')->take(8);
        //$productosUnicos = Producto::where('stock', 1)->take(8)->get();
        $categorias = Categoria::all()->sortBy('nombre');
        $promoSuperior = Promocion::where('bloque', 'SUPERIOR')->take(9)->get();
        $promoInferior = Promocion::where('bloque', 'INFERIOR')->take(9)->get();

        return view('market.index-market', [
            'productosMasNuevos' => $productosMasNuevos,
            'productosMasVendidos' => $productosMasVendidos,
            //'productosUnicos' => $productosUnicos,
            'categorias' => $categorias,
            'promoSuperior' => $promoSuperior,
            'promoInferior' => $promoInferior
        ]);
    }


    public function buscarPorTema($id, $orden = null)
    {
        $el_tema = Tema::find($id);
        $productos = Producto::all()->where('tema_id', '=', $el_tema->id)->sortBy('vendidos');

        if ($orden == 'Alfabetico')
            $productos = Producto::all()->where('tema_id', '=', $el_tema->id)->sortBy('nombre');
        elseif ($orden == 'Novedades')
            $productos = Producto::all()->where('tema_id', '=', $el_tema->id)->sortBy('created_at');
        elseif ($orden == 'Precio de menor a mayor')
            $productos = Producto::all()->where('tema_id', '=', $el_tema->id)->sortBy('precio');
        elseif ($orden == 'Precio de mayor a menor')
            $productos = Producto::all()->where('tema_id', '=', $el_tema->id)->sortByDesc('precio');

        // inicio - manejo de recomendados
        $listaCategorias = [];
        foreach ($productos as $producto)
            array_push($listaCategorias, $producto->categoria->nombre);

        $listaRecmendados = [];
        foreach ($listaCategorias as $listaCat) {
            if (sizeof($listaRecmendados) >= 6) break;

            foreach (Producto::all()->where('categoria_id', '=', Categoria::all()->where('nombre', '=', $listaCat)->first()->id) as $prod_rec)
                array_push($listaRecmendados, $prod_rec);
        }

        $final_recom = [];
        foreach ($listaRecmendados as $recs) {
            if (sizeof($final_recom) >= 6) break;
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

        return view('market.ver-tema', [
            'tema' => $el_tema,
            'ordenamientos' => $ordenarPor,
            'temas_all' => $productos,
            'cat_recomen' => $final_recom
        ]);
    }

    /**
     * Redirige a la vista de los productos filtrados por categoria.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function buscarPorCategoria($id, $orden = null)
    {
        $categoria = Categoria::find($id);
        $productos = Producto::all()->where('categoria_id', '=', $categoria->id)->sortBy('vendidos');

        if ($orden == 'Alfabetico')
            $productos = Producto::all()->where('categoria_id', '=', $categoria->id)->sortBy('nombre');
        elseif ($orden == 'Novedades')
            $productos = Producto::all()->where('categoria_id', '=', $categoria->id)->sortBy('created_at');
        elseif ($orden == 'Precio de menor a mayor')
            $productos = Producto::all()->where('categoria_id', '=', $categoria->id)->sortBy('precio');
        elseif ($orden == 'Precio de mayor a menor')
            $productos = Producto::all()->where('categoria_id', '=', $categoria->id)->sortByDesc('precio');

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
            if (sizeof($final_recom) >= 6) break;
            array_push($final_recom, $recs);
        }
        // fin - manejo de recomendados

        //$temaRel = Producto::inRandomOrder()->where('tema_id', '=', $producto->categoria_id)->limit(6)->get();

        $ordenarPor = [
            'Alfabetico',
            'Novedades',
            'Precio de menor a mayor',
            'Precio de mayor a menor',
            'Recomendados',
        ];

        return view('market.ver-categoria', [
            'categoria' => $categoria,
            'ordenamientos' => $ordenarPor,
            'productos_all' => $productos,
            'tema_recomen' => $final_recom
        ]);
    }

    public function reportar($id)
    {
        return view('market.reportar-producto', [
            'id' => $id
        ]);
    }

    /**
     * Redirige a la vista de los productos filtrados por texto/codigo/artista.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function buscar($texto, $orden = null)
    {
        $textobusqueda = $texto;

        $productos_searched = Producto::query()
            ->where('nombre', 'LIKE', "%{$textobusqueda}%")
            ->orderBy('vendidos')
            ->get();

        if ($orden == 'Alfabetico')
            $productos_searched = Producto::query()
                ->where('nombre', 'LIKE', "%{$textobusqueda}%")->orderBy('nombre')->get();
        elseif ($orden == 'Novedades')
            $productos_searched = Producto::query()
                ->where('nombre', 'LIKE', "%{$textobusqueda}%")->orderBy('created_at')->get();
        elseif ($orden == 'Precio de menor a mayor')
            $productos_searched = Producto::query()
                ->where('nombre', 'LIKE', "%{$textobusqueda}%")->orderBy('precio')->get();
        elseif ($orden == 'Precio de mayor a menor')
            $productos_searched = Producto::query()
                ->where('nombre', 'LIKE', "%{$textobusqueda}%")->orderBy('precio', 'DESC')->get();

        // inicio - manejo de recomendados
        $listaTemas = [];
        foreach ($productos_searched as $producto)
            array_push($listaTemas, $producto->tema->nombre);

        $listaRecmendados = [];
        foreach ($listaTemas as $listaTema) {
            if (sizeof($listaRecmendados) >= 6) break;

            foreach (Producto::all()->where('tema_id', '=',
                Tema::all()->where('nombre', '=', $listaTema)->first()->id) as $prod_rec)
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

        return view('market.index-buscados', [
            'productos_all' => $productos_searched,
            'ordenamientos' => $ordenarPor,
            'texto_bus' => $textobusqueda,
            'tema_recomen' => $final_recom
        ]);
    }

    /**
     * Vista del carrito de compras.
     */
    public function carrito()
    {
        return view("market.carrito");
    }

    /**
     * Vista del registro de información del despacho.
     */
    public function despacho()
    {
        return view("market.despacho");
    }

    /**
     * Genera el despacho, la orden y borra los productos del carrito.
     */
    public function generarOrden($datos)
    {

        // Obtiene el carrito del usuario.
        $carrito = $datos['carrito'];

        // Antes de generar la orden valida que ningún producto se haya puesto "no a la venta" durante el proceso.
        $cantProductosInicial = $carrito->productos->count();
        $cantProductosFinal = $carrito->productos()->where('en_venta', 1)->get()->count();

        if ($cantProductosFinal != $cantProductosInicial) {
            // Si la cantidad de productos difiere, significa que los productos en venta cambiaron durante el proceso.
            // Se genera un error.
            session()->flash('failure', 'Hubo un error generando su orden. Intente nuevamente.');
            return redirect()->route("carrito");
        }

        DB::transaction(function () use ($datos, $carrito) {
            // Crea el despacho.
            $despacho = Despacho::create($datos);

            // Define los datos de la orden.
            $datosOrden = [
                'usuario_id' => Auth::user()->id,
                'despacho_id' => $despacho->id,
                'monto_total' => $carrito->monto_total,
            ];

            // Crea la orden.
            $orden = Orden::create($datosOrden);

            // Por cada producto del carrito genera una tupla en orden_productos, aumenta la cantidad de vendidos y resta el stock.
            foreach ($carrito->productos as $producto) {
                $orden->productos()->attach($producto, ['cantidad' => $producto->pivot->cantidad, 'enviado' => 0]);
                $producto->stock -= $producto->pivot->cantidad;
                $producto->vendidos += $producto->pivot->cantidad;

                if ($producto->stock == 0) $producto->en_venta = false;
                $producto->save();
            }

            // Borra los productos del carrito.
            $carrito->productos()->detach();
        });

        session()->flash('success', 'Orden generada con éxito! Revise su sección de órdenes en market.');
        return redirect()->route("vista-perfil");
    }
}
