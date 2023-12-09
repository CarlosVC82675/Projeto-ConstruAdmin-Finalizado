<?php
//Feito por diego

namespace App\Http\Controllers;


use App\Models\obras;
use App\Models\Usuario;
use App\Services\UserService;

class SiteDashboardController extends Controller
{
  //DIEGO/OBRAS/Fora da obra
  public function dashboard()
  {
    $obras = Obras::all();
    return view('site.siteMenu.dashboard', compact('obras'));
  }
  public function criarobra()
  {
    $usuarios = Usuario::whereDoesntHave('obras')->get();

    $supervisores = UserService::FiltrarFunções('Supevisor');

    $apontadores = UserService::FiltrarFunções('Apontador');


    return view('site.siteObra.obra.criar', compact(['usuarios', 'supervisores', 'apontadores']));
  }

  public function DashboardDentro($id)
  {

    $obra = Obras::find($id);

    if (!$obra) {
      abort(404); // Ou redirecione para uma página de erro 404
    }

    return view('site.siteObra.obra.dashboard', compact('obra'));
  }
  
  public function foto($id)
  {
    $obra = Obras::find($id);
    $arquivos = $obra->arquivo;

    if (!$obra) {
      abort(404); // Ou redirecione para uma página de erro 404
    }

    return view('site.siteObra.arquivos.foto', compact('obra','arquivos'));
  }

  public function arquivo($id)
  {
    $obra = Obras::find($id);
    $arquivos = $obra->arquivo;

    if (!$obra) {
      abort(404); // Ou redirecione para uma página de erro 404
    }

    return view('site.siteObra.arquivos.arquivo', compact('obra','arquivos'));
  }

  public function edit($id)
  {
    $obra = Obras::find($id);
    return view('site.siteObra.obra.editar', compact('obra'));
  }
  //FIM DE DIEGO/OBRAS




}
