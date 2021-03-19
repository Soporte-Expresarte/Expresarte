<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\ExposicionController;
use App\Http\Controllers\NoticiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ArtistaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Ruta a la pagina principal del modulo galeria
//TODO: hay doble ruta a la url "/galeria" se debe borrar una
Route::get('/galeria', [GaleriaController::class, 'index'])->name('index-galeria');

// rutas para las obras
Route::get('/galeria/obras', [ObraController::class, 'index'])->name('index-exposiciones');
Route::get('/galeria/obras/ver/{obra}', [ObraController::class, 'show'])->name('show-obra');
Route::get('/galeria/obras/buscar', [ObraController::class, 'busqueda'])->name('buscar-obra');
Route::get('/galeria/obras/tipo/{tipo}', [ExposicionController::class, 'buscarPorTipo'])->name('buscar-tipo');

// rutas para las exposicines
Route::get('/galeria/exposiciones', [ExposicionController::class, 'index'])->name('index-expo');
Route::get('/galeria/exposiciones/ver/{id}', [ExposicionController::class, 'show'])->name('show-expo');


// rutas para las NOTICIAS
Route::get('/galeria/noticias', [NoticiaController::class, 'index'])->name('index-noticias');
Route::get('/galeria/noticias/ver/{noticia}', [NoticiaController::class, 'show'])->name('show-noticia');
Route::get('/galeria/noticias/ver/por-tag/{tag}', [NoticiaController::class, 'show_by_tag'])->name('show-by-tag');
Route::get('/galeria/noticias/buscar', [NoticiaController::class, 'busqueda'])->name('buscar-noticia');


Route::middleware(['auth:sanctum', 'verified', 'isArtist'])->group(function () {

    // funciones para administrador en obras
    Route::get('/galeria/obras/administrar-obras', [ObraController::class, 'adminObras'])->name('admin-obras');
    Route::get('/galeria/obras/crear', [ObraController::class, 'create'])->name('create-obra');
    Route::get('/galeria/obras/editar/{obra}', [ObraController::class, 'edit'])->name('edit-obra');
    Route::patch('/galeria/obras/actualizar/{obra}', [ObraController::class, 'update'])->name('update-obra');
});

Route::middleware(['auth:sanctum', 'verified', 'isAdmin'])->group(function () {

    // funciones para administrador en noticias
    Route::get('/galeria/noticias/crear', [NoticiaController::class, 'create'])->name('create-noticia');
    Route::get('/galeria/noticias/administrar-noticias', [NoticiaController::class, 'adminNoticias'])->name('admin-noticias');

    Route::get('/galeria/eventos/administrar-eventos', [EventoController::class, 'adminEventos'])->name('admin-eventos');
    Route::get('/galeria/eventos/editar/{evento}', [EventoController::class, 'editar'])->name('editar-evento');

    Route::get('/galeria/exposiciones/crear', [ExposicionController::class, 'create'])->name('create-expo');
    Route::get('/galeria/exposiciones/administrar-exposiciones', [ExposicionController::class, 'admin'])->name('admin-expo');
    Route::get('/galeria/exposiciones/editar/{id}', [ExposicionController::class, 'edit'])->name('edit-expo');

    Route::get('/carruseles/administrar', [GaleriaController::class, 'admin_carruseles'])->name('admin-carrusel');
    Route::get('/carruseles/editar/{id}', [GaleriaController::class, 'create_carrusel'])->name('create-carruse');
});

// funcion para crear evento (admin y artista)
Route::get('/galeria/eventos/crear', [EventoController::class, 'create'])->name('crear-evento');

// ruta para el perfil del admin
//Route::get('/perfil/galeria/admin/perfil-admin', [EventoController::class, 'create'])->name('perfil-admin');

// rutas para los artistas (los perfiles)
Route::get('/galeria/artistas', [ArtistaController::class, 'index'])->name('index-artistas');
Route::get('/galeria/artistas/ver/{apodo}', [ArtistaController::class, 'show'])->name('show-artista');
Route::get('/galeria/artistas/buscar', [ArtistaController::class, 'busqueda'])->name('buscar-artista');

// rutas para las EVENTOS
Route::get('/galeria/eventos', [EventoController::class, 'index'])->name('index-eventos');
Route::get('/galeria/eventos/ver/{id}', [EventoController::class, 'show'])->name('show-evento');
Route::get('/galeria/eventos/ver/por-periodo/{orden}', [EventoController::class, 'showPorPeriodo'])->name('show-evento-periodo');
Route::get('/galeria/eventos/buscar', [EventoController::class, 'busqueda'])->name('buscar-evento');
