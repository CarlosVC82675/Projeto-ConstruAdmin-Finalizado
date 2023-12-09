<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\obras;
use App\Models\Materiais_Estoque;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class SiteDashboardController extends Controller
{
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

      //SITE ANA/MATERIAIS

      public function verMateriais(){
        $materiais = Materiais_Estoque::all();
        return view('site.siteMenu.estoque.materialVer', compact('materiais'));
      }
      //FIM SITE ANA MATERIAIS




}
