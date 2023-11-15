<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\obras;

class SiteController extends Controller
{
    public function index()
    {
      $obras = Obras::all(); 
       return view('site.welcome',compact('obras'));
    
    }
    public function criarobra()
    {
       return view('site.criarobra');
    
    }

   


    
}