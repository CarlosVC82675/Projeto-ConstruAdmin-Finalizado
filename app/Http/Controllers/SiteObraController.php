<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteObraController extends Controller
{
  
   public function Kanban_atividades_view(){
      return redirect()->route('Atividade.Listar');
   }
   
   
}
