<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function create(array $data, array $fotoArtista, array $fotoPortada, User $userActual) {



        $perfil = Perfil::create($data);
        $perfil->save();

        $userActual->update([
                             'perfil_id' => $perfil->id
                         ]);

        $rutaArtista = Storage::disk('public')->put('imagenes-galeria/perfiles',
                                                    $fotoArtista[0]);
        $rutaPortada = Storage::disk('public')->put('imagenes-galeria/perfiles',
                                                    $fotoPortada[0]);


        $perfil->update([
                            'foto_artista' => "storage/" . $rutaArtista,
                            'foto_portada' => "storage/" . $rutaPortada,
                        ]);


        session()->flash('success', 'Datos creados correctamente.');
        return redirect()->route('index-artistas');

    }

    public function edit(array $data, Perfil $perfil, array $fotoArtista, array $fotoPortada, string $rutaArtistaAntigua, string $rutaPortadaAntigua) {

        if (!empty($fotoArtista)){
            $rutaArtista = Storage::disk('public')->put('imagenes-galeria/perfiles',
                                                        $fotoArtista[0]);
            $perfil->update([
                                'foto_artista' => "storage/" . $rutaArtista,
                            ]);

            $splitter = explode("storage/", $rutaArtistaAntigua);
            $rutaBorrar = $splitter[1];
            Storage::disk('public')->delete($rutaBorrar);
        }

        if (!empty($fotoPortada)){
            $rutaPortada = Storage::disk('public')->put('imagenes-galeria/perfiles',
                                                        $fotoPortada[0]);
            $perfil->update([
                                'foto_portada' => "storage/" . $rutaPortada,
                            ]);
            $splitter = explode("storage/", $rutaPortadaAntigua);
            $rutaBorrar = $splitter[1];
            Storage::disk('public')->delete($rutaBorrar);
        }

        $perfil->fill($data)->save();



        session()->flash('success', 'Datos actualizados correctamente.');
        return redirect()->route('index-artistas');
    }
}
