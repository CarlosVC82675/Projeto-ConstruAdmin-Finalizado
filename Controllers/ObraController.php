<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\obras;
use App\Models\arquivo;


class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Dashboard($id)
    {
        
            $obra = Obras::find($id);
    
            if (!$obra) {
                abort(404); // Ou redirecione para uma página de erro 404
            }
    
            return view('obra.dashboard', compact('obra'));
        }

        public function arquivo($id)
        {
            
            $obra = Obras::find($id);
            $arquivos = $obra->arquivo;
    
            if (!$obra) {
                abort(404); // Ou redirecione para uma página de erro 404
            }
                
        
                return view('obra.arquivo',compact('obra','arquivos'));
            }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Obras::create($request->all());
        return redirect()->route('site.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
