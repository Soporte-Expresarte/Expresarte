<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Livewire\Crowdfunding\ListadoProyectos;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas para Crowdfunding
|--------------------------------------------------------------------------
|
*/

// Ruta a la pagina principal del modulo crowdfunding
Route::get('/crowdfunding',
    [ProyectoController::class, 'index']
)->name('index-crowdfunding');

// Ruta listado proyectos
Route::get('/crowdfunding/listado-proyectos',
    [ProyectoController::class, 'listadoProyectos'])
    ->name('listado-proyectos');

Route::resource('proyecto', ProyectoController::class);

// visualizacion de un proyecto
Route::get('/crowdfunding/proyecto/{id}',
    [ProyectoController::class, 'show'])
    ->name('mostrar-proyecto');

// ver un conjunto de proyectos segun alguna clasificacion
Route::get('/crowdfunding/proyectos-por/{clasificacion?}', [ProyectoController::class, 'indexPorClasificacion'])->name('index-clasificacion');

Route::middleware(['auth:sanctum', 'verified', 'isAdmin'])->group(function () {
    // Rutas accedidas por el administrador.

    // Visualizacion de un proyecto por administrador(para aprobar)
    Route::get('/crowdfunding/proyecto-admin/{id}',
        [ProyectoController::class, 'showAdmin'])
        ->name('mostrar-proyecto-admin');

    // aprobacion de un proyecto
    Route::get('/crowdfunding/aprobar-proyecto/{id}',
        [ProyectoController::class, 'aprobar'])
        ->name('aprobar-proyecto');

    // rechazo de un proyecto
    Route::get('/crowdfunding/rechazar-proyecto/{id}',
        [ProyectoController::class, 'rechazar'])
        ->name('rechazar-proyecto');
});

Route::middleware(['auth:sanctum', 'verified', 'isArtist'])->group(function () {

    // Agregar aqui todas las rutas que solo pueden ser accedidas por artistas
    Route::get(
        '/crowdfunding/crear-proyecto',
        [ProyectoController::class, 'crearProyecto'])
        ->name('crear-proyecto');

    Route::get('/crowdfunding/editar-proyecto/{id}', [ProyectoController::class, 'edit'])->name('editar-proyecto');
});

Route::middleware(['auth:sanctum', 'verified', 'isNormalUser'])->group(function () {

    // Agregar aqui todas las rutas que solo pueden ser accedidas por usuarios normales
    Route::get(
        '/crowdfunding/escoger-premios/{id}',
        [ProyectoController::class, 'escogerPremios'])
        ->name('escoger-premios');

});

Route::middleware(['auth:sanctum', 'verified', 'isNotAdmin'])->group(function () {
    // Agregar aqui todas las rutas que solo pueden ser accedidas por usuarios normales
    Route::get(
        '/crowdfunding/escoger-premios/artista/{id}',
        [ProyectoController::class, 'escogerPremios'])
        ->name('escoger-premios-art');
});


/*
Route::get('/crowdfunding/proyecto/registro', function(){
    return view('crowdfunding.crear-proyecto');
})->middleware('auth');
*/
