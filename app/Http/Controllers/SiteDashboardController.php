<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obras;
use App\Models\Usuario;
use App\Services\ExceptionHandlerService;
use App\Models\Materiais_Estoque;
use App\Services\UserService;

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

   //DIEGO/OBRAS/FORA DA OBRA
    public function dashboard()
    {
        $obras = Obras::all();
        return view('site.siteMenu.Dashboard', compact('obras'));
    }

    public function criarobra()
    {
        $usuarios = Usuario::whereDoesntHave('obras')->get();

        $supervisores = UserService::filtrarFunções('Supervisor');

        $apontadores = UserService::filtrarFunções('Apontador');


        return view('site.siteObra.obra.criar', compact(['usuarios', 'supervisores', 'apontadores']));
    }

    public function edit($id)
    {
        $obra = Obras::find($id);
        return view('site.siteObra.obra.editar', compact('obra'));
    }
  //FIM DE DIEGO/OBRAS


  //CARLOS/USUARIO/FORA DA OBRA
    public function ViewUsuarios()
    {
            $usuarios = $this->userService->buscarTodosUsuario();
            return view("site.siteMenu.usuario.ListaUsuarios", compact('usuarios'));
    }
  //FIM DE CARLOS/USUARIO


  //lOGIN
   public function index(){
    return view('site.login.form');
   }
  //FIM DO LOGIN

   //SITE ANA/MATERIAIS
    public function verMateriais(){
        $materiais = Materiais_Estoque::all();
        return view('site.siteMenu.estoque.materialVer', compact('materiais'));
    }
  //FIM SITE ANA MATERIAIS

}
