<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class NA2Middleware
{   //NIVEL DE ACESSO 2, PARA APONTADORES, ENGENHEIROS E EMPREITEIROS E ACIMA

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $NiveisDeAcesso = [1, 2, 3, 4];

        //in_array: verificar se os valores existem
        //ou seja, se nao tive os valores que estao presentes no array NiveisDeAcesso
        if(Auth::check() && !in_array(Auth::user()->atribuicao_Usuario_id_Atribuicao, $NiveisDeAcesso)){
            return redirect()->back()->with('error','Acesso não autorizado.');
        }
        return $next($request);
    }
}
