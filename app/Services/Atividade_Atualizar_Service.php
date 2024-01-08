<?php

 namespace App\Services;
 use App\Models\Atividades;
 use Illuminate\Http\Request;
 use Illuminate\Database\QueryException;
 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Log;
 use Illuminate\Support\Facades\Storage;
class Atividade_Atualizar_Service
{

    public function atualizarAtividade(Request $request, $atividade){



        $anexosPaths = [];
        if ($request->hasFile('anexoV')) {
            foreach ($request->file('anexoV') as $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $anexoPath = $file->store('public/photos/atividade_anexo');
                    $anexoPath = Storage::url($anexoPath);
                    $anexosPaths[] = $anexoPath;
                }
            }
        }

        $etiquetasPaths = [];
        if ($request->hasFile('etiquetaV')) {
            foreach ($request->file('etiquetaV') as $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $etiquetaPath = $file->store('public/photos/atividade_etiqueta');
                    $etiquetaPath = Storage::url($etiquetaPath);
                    $etiquetasPaths[] = $etiquetaPath;
                }
            }
        }



        $atividade->update([
            'nome' => $request->input('nomeV'),
            'descricao' => $request->input('descricaoV'),
            'dtFinal' => $request->input('dtFinalV'),
            'dtInicial' => $request->input('dtInicialV'),
            'status' => $request->input('statusV'),
            'anexo' => implode(';', $anexosPaths),
            'etiqueta' => implode(';', $etiquetasPaths),
            'card_atividades_idCard' => $request->input('card_atividades_idCardV'),
        ]);




    }




}


?>
