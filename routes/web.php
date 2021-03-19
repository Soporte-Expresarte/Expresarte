<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProyectoController;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Perfil\VistaPerfil;

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

// Ruta inicial (index)
Route::get('/', function () {
    return view('galeria.index-galeria');
})->name('root');

// Ruta para registrar artistas(solo el admin puede entrar)
Route::middleware(['auth:sanctum', 'verified', 'isAdmin'])->group(function () {
    Route::get('admin/registro_artista', [AdminController::class, 'crearArtista'])->name('crear_artista');
});

// Vistas livewire
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/perfil', VistaPerfil::class)->name('vista-perfil');
});

Route::get('/politicas-privacidad', function () {
    return view('layouts.politicas-privacidad');
})->name('politicas-privacidad');
