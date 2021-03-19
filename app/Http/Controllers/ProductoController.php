<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ImagenProducto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductoController extends Controller
{

    /**
     * Redirige a la vista de la creación de un producto.
     */
    public function crear()
    {
        return view('market.crear-producto');
    }

    /**
     * Agrega un nuevo producto a la Base de datos.
     *
     * @param array $datitos
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registrar($datitos)
    {
        //Se guarda el proyecto en la base de datos
        $producto = new Producto([
            'nombre' => $datitos['nombre'],
            'descripcion' => $datitos['descripcion'],
            'categoria_id' => $datitos['categoria_id'],
            'tema_id' => $datitos['tema_id'],
            'usuario_id' => Auth::id(),

            'largo' => $datitos['largo'],
            'ancho' => $datitos['ancho'],
            'alto' => $datitos['alto'],

            'vendidos' => 0,
            'slug' => Str::slug($datitos['nombre']),

            'precio' => $datitos['precio'],
            'stock' => $datitos['stock'],
        ]);

        $producto->save();

        foreach ($datitos['imagenes'] as $imagen) {
            $ruta = Storage::disk('public')->put('imagenes-market/productos', $imagen);

            ImagenProducto::create([
                'ruta' => "storage/" . $ruta,
                'producto_id' => $producto->id,
            ]);
        }

        session()->flash('success', 'Producto creado satisfactoriamente.');
        return redirect()->route('index-market');
    }

    /**
     * Redirige a la vista de la edición de un producto.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function editar($slug)
    {
        return view('market.editar-producto', ['slug' => $slug]);
    }

    /**
     * Actualiza un producto ya existente en la base de datos.
     *
     * @param array $data
     * @param Producto $producto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actualizar(array $data, Producto $producto)
    {
        $producto->fill($data)->save();

        if (isset($data['imagenes'])) {
            // Almacena las nuevas imágenes y crea su modelo en la BD.
            foreach ($data['imagenes'] as $imagen) {
                // Imágenes agregadas en la edición (Livewire/TemporaryUploadedFile)
                $ruta = Storage::disk('public')->put('imagenes-market/productos', $imagen);

                $imagen = ImagenProducto::create([
                    'ruta' => "storage/" . $ruta,
                    'producto_id' => $producto->id,
                ]);
            }
        }

        session()->flash('success', 'Producto actualizado satisfactoriamente.');
        return redirect()->route('vista-perfil');
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function eliminar($id)
    {

        // Verificar si el producto ya ha recibido ordenes
        $producto = Producto::find($id);

        // Si ha recibido ordenes entonces debe ocultarse de la interfaz, pero no de DB
        if ($producto->ordenes()->count() != 0) {
            $producto->en_venta = false;
            $producto->save();

            $producto->carros()->detach();
        } else {
            $imagenes = ImagenProducto::where('producto_id', $id)->get();

            DB::transaction(function () use ($imagenes, $id) {
                // Se eliminan todas las imágenes asociadas al producto que se quiere eliminar.
                foreach ($imagenes as $imagen) {
                    // Se obtiene la ruta en un arreglo de Strings.
                    $splitter = explode("storage/", $imagen->ruta);

                    if (isset($splitter[1])) {
                        // Si entra al if significa que la imagen está almacenada en storage/

                        // La ruta está en la 2da posición del arreglo.
                        $nombre = $splitter[1];
                        // Se elimina la imagen del directorio.
                        Storage::delete("public/" . $nombre);
                        // Elimina la imagen en la BD asociada a un producto.
                        $imagen->delete();
                    }
                }

                // Obtiene el producto que será eliminado.
                $producto = Producto::find($id);

                // Desvincula todos los carros de market en los que está.
                $producto->carros()->detach();

                // Elimina el producto de la BD.
                $producto = Producto::find($id)->delete();
            });
        }

        session()->flash('success', 'Producto eliminado satisfactoriamente.');
        // Retornar a la vista del perfil en market.
        return redirect()->back();
    }

    /**
     * Ver un producto particular en detalle.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function ver($slug)
    {

        $producto = Producto::where('slug', '=', $slug)->first();
        $relacionados = Producto::inRandomOrder()->where('usuario_id', '=', $producto->artista->id)->limit(6)->get();
        $categoriaRel = Producto::inRandomOrder()
            //->where('usuario_id', '=', $producto->artista->id)
            ->where('categoria_id', '=', $producto->categoria_id)
            ->limit(6)->get();

        // Si no existe ejecuta un error 404.
        if (!$producto) {
            abort('404');
        }

        return view('market.ver-producto', [
            'producto' => $producto,
            'relacionados' => $relacionados,
            'categoria_rel' => $categoriaRel
        ]);
    }
}
