<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      
        if(!auth()->check()){
            return redirect('login.form');
        }

        //vai pega o email dele
        $email = auth()->user()->email;

        //@utilizado como ponto de divisão
        $data = explode('@', $email);

        //ver se o email e um gmail
        $servidorEmail = $data[1];

        if($servidorEmail != 'gmail.com' && $servidorEmail != 'outlook.com'){
            return redirect(route('login.form'));
        }

        //se nao entra em nenhum if, ele vai proceder com a solicitação
        return $next($request);
    }
}
