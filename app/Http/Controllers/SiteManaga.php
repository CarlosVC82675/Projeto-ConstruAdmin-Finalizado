<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Atividades;
class SiteManaga extends Controller
{
  
    
public function index(){
    return view("site.layoult_base");
}

    public function criar_atv(){
       return view('Criar_Atividade');
    }
  
    
  
     
}
