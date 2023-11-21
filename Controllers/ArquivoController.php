<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arquivo;
use Illuminate\Support\Facades\File;
class ArquivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request,$id)
    {

       

        $file = $request->file('caminho');
        

        $data = $request->validate([
            'nome'=>['required','max:50'],
            'caminho'=>['required']
        ],[
            'nome.required'=>'Prencha o campo Nome',
            'caminho.required'=>'Prencha o campo do arquivo',
            'nome.max' => 'O limite de caracteres para Nome é 50'
        ]);
        $data['caminho'] = $file->store('arquivo','public');
        $data['Obras_IdObras'] = $id;
        $data['nome'] = $request->nome;
        $data['extensao'] = $file->getClientOriginalExtension();
        $data['tipo'] = $request->tipo;
        $file->store('arquivo','public');
      
        arquivo::create(['caminho'=>$data['caminho'],'Obras_IdObras'=>$data['Obras_IdObras'],'nome'=>$data['nome'],'tipo'=>$data['tipo'],'extensao'=>$data['extensao']]);
        if($request->tipo == 1){
        return redirect()->route('obra.foto', ['id' => $id]);
        }else{return redirect()->route('obra.arquivo', ['id' => $id]);}
        


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
    public function destroy($id,$ida)
    {
        
       $arquiv = Arquivo::find($ida);
       
       $arquiv->delete();
       File::delete(storage_path("app/public/{$arquiv->caminho}"));
       if($arquiv->tipo == 1){
        return redirect()->route('obra.foto', ['id' => $id]);
        }else{return redirect()->route('obra.arquivo', ['id' => $id]);}
    }

    public function download($ida){
       $arquiv = Arquivo::find($ida);
       $tipo_mime = File::extension(storage_path("app/public/{$arquiv->caminho}"));
    
       return response()->download(storage_path("app/public/{$arquiv->caminho}"), $arquiv->nome ."." . $arquiv->extensao,[
        'Content-Type' => $tipo_mime,
       ]);



    }
}
