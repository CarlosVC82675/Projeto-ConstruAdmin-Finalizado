<?php

namespace App\Http\Controllers;

use App\Models\Atividades;
use App\Models\Obra;
use App\Models\usuarios;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class AtividadesController extends Controller
{
 
    public function Listar_ATV_Obra()
{
//if (Auth::check()) {
   // $idObra = Auth::user()->obra->idObra;
   $idObra=1;
    $atividades = Atividades::with('usuarios')->where('Obras_idObras', $idObra)->get();

    return view('Listar_atividade', compact('atividades'));
}



 
    public function adicionarAtividade(Request $request)
    {
        try {
          /*  $anexosPaths = [];
            $etiquetasPaths = [];
            if (Auth::check()) {
                $userId = Auth::id();
            } else{
                dd('nao tem usuario logado');
            }*/


            $request->validate([
                'nome' => 'required|string',
                'etiqueta.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
                'anexo.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
                'descricao' => 'required|string',
                'dtFinal' => 'required|date',
                'dtInicial' => 'required|date',
                'status' => 'required|in:COMEÇANDO,ANDAMENTO,FINALIZADO',
                'Obras_idObras' => 'required|exists:obras,idObra',
            ]);


       
    
            if ($request->hasFile('anexo')) {
                foreach ($request->file('anexo') as $file) {
                    $anexoPath = $file->store('public/photos');
                    $anexoPath = str_replace('public/', 'storage/', $anexoPath);
                    $anexosPaths[] = $anexoPath;
                }
            }
    
            if ($request->hasFile('etiqueta')) {
                foreach ($request->file('etiqueta') as $file) {
                    $etiquetaPath = $file->store('public/photos');
                    $etiquetaPath = str_replace('public/', 'storage/', $etiquetaPath);
                    $etiquetasPaths[] = $etiquetaPath;
                }
            }
    
            $Atividades =  Atividades::create([
                'nome' => $request->input('nome'),
                'etiqueta' => implode(';', $etiquetasPaths),
                'anexo' => implode(';', $anexosPaths),
                'descricao' => $request->input('descricao'),
                'dtFinal' => $request->input('dtFinal'),
                'dtInicial' => $request->input('dtInicial'),
                'status' => $request->input('status'),
                'Obras_idObras' => $request->input('Obras_idObras'),
            ]);
            $userId = 2;
            try {
                $this->associarUsuarioAtividade($Atividades->idAtividade, $userId);
            } catch (QueryException $qe) {
               
                dd('Erro ao associar usuário à atividade: ' . $qe->getMessage());
            }


            return redirect()->route('criar_atv')->with('success', 'Atividade criada com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
       
            $errors = $e->errors();
            dd($errors);
        } catch (QueryException $e) {
            dd('Erro ao criar atividade: ' . $e->getMessage());
        }
    }





    public function associarUsuarioAtividade($atividadeId, $usuarioId)
    {
        {
            if ($atividadeId !== null && $usuarioId !== null) {
                try {
                  
                   
                    DB::table('lista_Atividades')->insert([
                        'Atividade_idAtividade' => $atividadeId,
                        'Usuarios_idUsuario' => $usuarioId,
                    ]);
        
                    return redirect()->route('criar_atv')->with('success', 'Usuário associado com sucesso à atividade.');
                } catch (\Exception $e) {
                    return redirect()->route('criar_atv')->with('error', 'Erro ao associar usuário à atividade: ' . $e->getMessage());
                }
            } else {
                dd('Algum campo é null', 'id da atividade: ' . $atividadeId , ' id do usuário: ' . $usuarioId);
            }
        }


    }
    public function atualizarAtividade(Request $request, $idAtividade)
    {

        $atividade = Atividades::findOrFail($idAtividade);

        $request->validate([
            'nome' => 'required|string',
            'etiqueta.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
            'anexo.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
            'descricao' => 'required|string',
            'dtFinal' => 'required|date',
            'dtInicial' => 'required|date',
            'status' => 'required|in:COMEÇANDO,ANDAMENTO,FINALIZADO',
            'Obras_idObras' => 'required|exists:obras,idObra',
        ]);
    
        if ($request->hasFile('anexo')) {
            $anexosPaths = [];
            foreach ($request->file('anexo') as $file) {
                $anexoPath = $file->store('public/photos');
                $anexoPath = str_replace('public/', 'storage/', $anexoPath);
                $anexosPaths[] = $anexoPath;
            }
        }
    
     
        if ($request->hasFile('etiqueta')) {
            $etiquetasPaths = [];
            foreach ($request->file('etiqueta') as $file) {
                $etiquetaPath = $file->store('public/photos');
                $etiquetaPath = str_replace('public/', 'storage/', $etiquetaPath);
                $etiquetasPaths[] = $etiquetaPath;
            }
        }
    
    
        $atividade->update($request->except(['etiqueta', 'anexo']));
    
        if (isset($anexosPaths)) {
            $atividade->update(['anexo' => implode(';', $anexosPaths)]);
        }
    
        if (isset($etiquetasPaths)) {
            $atividade->update(['etiqueta' => implode(';', $etiquetasPaths)]);
        }
    
        return redirect()->route('listar_atv')->with('success', 'Atividade atualizada com sucesso!');
    }



    public function editar_atv($idAtividade)
    {
        $atividade = Atividades::findOrFail($idAtividade);
       
        return view('editar_atividade', compact('atividade'));
    }

   
    public function delete_atv($idAtividade)
    {
        try {
           
            DB::table('lista_atividades')->where('Atividade_idAtividade', $idAtividade)->delete();
    
          
            Atividades::findOrFail($idAtividade)->delete();
    
            return redirect()->route('listar_atv')->with('Sucess', 'Produto removido com sucesso');
        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }
    }





    public function store(Request $request)
    {
     
    }


    public function show(Atividades $atividades)
    {
      
    }

    public function edit(Atividades $atividades)
    {
      
    }
}