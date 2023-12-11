<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;


class NA1Middleware
{   //NIVEL DE ACESSO 1, PARA Apontadores E ACIMA
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Redirecionar se o usuário não estiver autenticado
            return redirect()->route('login.form');
        }

        $usuario = Usuario::find(Auth::id());

        //in_array: verificar se os valores existem
        //ou seja, se nao tive os valores que estao presentes no array NiveisDeAcesso
        if (!$usuario || !$usuario->hasRole('Administrador') && !$usuario->hasRole('Apontador')) {
            return redirect()->back()->with('error','Acesso não autorizado.');
        }
        return $next($request);
    }
}
