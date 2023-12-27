<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usuario;

class AdmAcess
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,): Response
    {
        if (!Auth::check()) {
            // Redirecionar se o usuário não estiver autenticado
            return redirect()->route('login.form');
        }
        
        $usuario = Usuario::find(Auth::id());
        if (!$usuario || !$usuario->hasRole('Administrador')) {
            return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
        }

        return $next($request);
    }
}
