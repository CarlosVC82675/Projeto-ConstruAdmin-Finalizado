<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\obras;
use App\Services\UserService;
use App\Services\ExceptionHandlerService;


class SiteDashboardController extends Controller
{

    protected $userService;
    protected $exceptionHandler;

    //injeção de dependencia
    public function __construct(UserService $userService,  ExceptionHandlerService $exceptionHandler)
    {
        $this->userService = $userService;
        $this->exceptionHandler = $exceptionHandler;
    }

       //DIEGO/OBRAS/Fora da obra
       public function dashboard()
       {
         $obras = Obras::all();
          return view('site.siteMenu.dashboard',compact('obras'));

       }
       public function criarobra()
       {
          return view('site.siteObra.obra.criarobra');

       }
       public function desativadas(){
         $obras = Obras::all();
         return view('site.siteObra.obra.desativadas',compact('obras'));
       }
       //FIM DE DIEGO/OBRAS







    public function ViewUsuarios()
    {
        $usuarios = $this->userService->buscarTodosUsuario();

        $dados = [
            ['categoria' => 'Admin', 'total' => 0],
            ['categoria' => 'Supervisor', 'total' => 0],
            ['categoria' => 'Cliente', 'total' => 0],
            // Adicione mais categorias conforme necessário
        ];

        foreach ($usuarios as $usuario) {
            if ($usuario->hasRole('administrador')) {
                $dados[0]['total']++;
            } elseif ($usuario->hasRole('supervisor')) {
                $dados[1]['total']++;
            } elseif ($usuario->hasRole('cliente')) {
                $dados[2]['total']++;
            }
            // Adicione mais condições para outras categorias
        }


          return view("site.siteMenu.usuario.ListaUsuarios", compact('usuarios', 'dados'));
    }


    public function ViewUsuario($idUsuario)
    {
        try {
        $usuario = $this->userService->buscarUsuarioPorId($idUsuario);
         } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
        }

        return view("VerUsuario",compact('usuario'));
    }

  


}
