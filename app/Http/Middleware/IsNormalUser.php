<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsNormalUser
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
        if (Auth::user()->currentTeam->count() === 0) {
            return redirect()->route('root');
        }
        if (Auth::user()->currentTeam->name != "Usuarios") {
            return redirect()->route('root');
        }


        return $next($request);
    }
}
