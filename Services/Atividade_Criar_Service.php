<?php 

namespace App\Services;

use App\Models\Atividades;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;



class Atividade_Criar_Service
{


    
    public function adicionarAtividade(Request $request){
        try{
        DB::beginTransaction();
    
         

            $anexosPaths = [];
            $etiquetasPaths = [];


            if ($request->hasFile('anexo')) {
                foreach ($request->file('anexo') as $file) {
                    $anexoPath = $file->store('public/photos/atividade_anexo');
                    $anexoPath = Storage::url($anexoPath);
                    $anexosPaths[] = $anexoPath;
                }
            }


            if ($request->hasFile('etiqueta')) {
                foreach ($request->file('etiqueta') as $file) {
                    $etiquetaPath = $file->store('public/photos/atividade_etiqueta');
                    $etiquetaPath = Storage::url($etiquetaPath);
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
                'card_atividades_idCard' => $request->input('card_atividades_idCard')
            ]);
           
            
            


           
                DB::commit();
                return $Atividades->idAtividade;
            } catch (QueryException $qe) {

                log::error('Erro ao criar Atividade '.$qe);
                DB::rollBack();
            }
           

       
    }
}


?>