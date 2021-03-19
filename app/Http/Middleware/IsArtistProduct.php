<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class IsArtistProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $slug_producto = $request->route('slug');
        $producto = Producto::where('slug', $slug_producto)->first();

        if (Auth::user()->id == $producto->usuario_id) {
            return $next($request);
        }

        return Response(view('market.edicion-fallida-producto'));
    }
}
