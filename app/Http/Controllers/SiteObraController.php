<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\obras;


class SiteObraController extends Controller
{
    public function dashboard($idObra)
    {
      $obra = Obras::findOrFail($idObra);
       return view('site.siteObra.dashboard',compact('obra'));

    }
}
