<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Carro;

class AdminController extends Controller
{

    /**
     * Redirige a la vista del registro de un artista.
     */
    public function crearArtista() {
        return view('admin.registro-artista');
    }

    /**
     * Registra un usuario artista en el sistema.
     * @param array $data
     * @return Response
     */
    public function registrarArtista(array $data) {
        $data['password'] = bcrypt($data['password']);

        // Se crea una instancia de carro de compras y se asocia al usuario.
        $carro = Carro::create();
        $data['carro_id'] = $carro->id;

        // Se crea el artista en la BD.
        User::create($data);

        session()->flash('success', 'Artista creado satisfactoriamente.');
        return redirect()->to('/admin/registro_artista');
    }
}
