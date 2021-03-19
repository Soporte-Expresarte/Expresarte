<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PromocionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketController;
use App\Http\Livewire\Market\ProcesoDespacho;

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

// Pagina principal de market.
Route::get('/market', [MarketController::class, 'index'])->name('index-market');

// Vistas grid de productos.
Route::get('/market/categoria/ver/{id}/{orden?}', [MarketController::class, 'buscarPorCategoria'])->name('buscarPorCategoria');
Route::get('/market/tema/ver/{id}/{orden?}', [MarketController::class, 'buscarPorTema'])->name('buscarPorTema');
Route::get('/market/buscar/{texto}/{orden?}', [MarketController::class, 'buscar'])->name('buscarPorTexto');

// Vista especifica de un producto.
Route::get('/market/productos/{slug}', [ProductoController::class, 'ver'])->name('ver-producto');

// ver una pagina de promociones con productos
Route::get('/market/promocione/ver/{id}/{orden?}', [PromocionController::class, 'show'])->name('ver-promocion');

Route::middleware(['auth:sanctum', 'verified', 'isNotAdmin'])->group(function () {
    // Rutas que solo pueden ser accedidas por usuarios logeados.
    Route::get("/market/carrito", [MarketController::class, 'carrito'])->name("carrito");
    Route::get("/market/despacho", ProcesoDespacho::class)->name("despacho");
    Route::get('/market/reportar/{id}', [MarketController::class, 'reportar'])->name('reportar-producto');
});

Route::middleware(['auth:sanctum', 'verified', 'isArtist'])->group(function () {
    // Rutas que solo pueden ser accedidas por artistas.
    Route::get('/market/productos/gestion/crear', [ProductoController::class, 'crear'])->name('crear-producto');
    Route::get('/market/productos/gestion/editar/{slug}', [ProductoController::class, 'editar'])->name('editar-producto')->middleware('isArtistProduct');
    Route::get('/market/productos/gestion/eliminar/{id}', [ProductoController::class, 'eliminar'])->name('eliminar-producto');
});

Route::middleware(['auth:sanctum', 'verified', 'isAdmin'])->group(function () {
    Route::get('/market/promociones/crear', [PromocionController::class, 'create'])->name('create-promocion');
    Route::get('/market/promociones/admin', [PromocionController::class, 'admin'])->name('admin-promocion');
    Route::get('/market/promociones/edit/{id}', [PromocionController::class, 'edit'])->name('edit-promocion');
});
