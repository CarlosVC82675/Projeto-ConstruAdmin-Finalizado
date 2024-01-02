<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function auth(Request $request){
        //fazer validação
        $crendencias = $request->validate([
            'Email' => ['required','email'],
            'password' => ['required'],
        ], [
            //Customizando possiveis erros baseados na validaçao
            'Email.required' => 'o campo email é obrigatorio',
            'Email.email' => 'o email nao e valido',
            'password.required' => 'o campo senha é obrigatorio',
        ]
        );


        if(Auth::attempt($crendencias, $request->remember)){
            $request->session()->regenerate();
            //vai fazer o redirecionamento, mas vai verificar se o usario veio de algum lugar

            if(Auth::user()->atribuicao_Usuario_id_Atribuicao == 5){
                //redireciona ele para a pagina do cliente
            }
            return redirect()->route('site.index');
            }
            else{
                return redirect()->back()->with('erro', 'Credenciais inválidas. Tente novamente.');
        }

    }


    public function logout(Request $request){
        Auth::logout();
        //invalida requisição
        $request->session()->invalidate();
        //gerar novo token
        $request->session()->regenerateToken();
        //retorna para pagina de login
        return redirect()->route('login.form');
    }




}



/*
Gerar um novo token CSRF (Cross-Site Request Forgery) após o logout é uma medida de segurança recomendada para proteger
contra possíveis ataques de falsificação de solicitação entre sites.

Um token CSRF é um valor exclusivo e aleatório que é
gerado para cada sessão do usuário. Ele é incluído em formulários e solicitações HTTP
para verificar a validade da origem da solicitação.
Se um token CSRF não corresponder ao esperado, a solicitação pode ser considerada inválida e rejeitada.

Ao gerar um novo token CSRF após o logout,
você garante que qualquer solicitação subsequente feita
por um agente mal-intencionado que possa ter obtido o token anterior (durante a sessão do usuário) seja invalidada. Isso diminui a probabilidade de que um token válido seja reutilizado para realizar ações não autorizadas após o logout.
*/
