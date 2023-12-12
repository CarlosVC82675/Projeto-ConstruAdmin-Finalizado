<?php

namespace App\Http\Controllers;

use App\Models\Atividades;
use App\Models\Comentarios;
use App\Models\usuarios;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\AtribuicaoUsuario;
use App\Models\card_atividades;
use App\Models\Obras;
use App\Models\Usuario;
use Illuminate\Validation\ValidationException;
use App\Services\UserService;
use function Laravel\Prompts\error;

class AtividadesController extends Controller
{
    protected $userService;

    //injeção de dependencia
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function Listar_ATV_Obra($idobra)
{
   //if (Auth::check()) {
   // $idObra = Auth::user()->obra->idObra;

   $obra = Obras::find($idobra);



   $cardAtividade = card_atividades::where('Obras_idObras', $idobra)
   ->with([
       'atividade' => function ($query) {
           $query->with(['usuarios.roles', 'usuarios.Comentarios']);
       }
   ])
   ->get();



   return view('site.siteObra.atividade.Lista_Atividade', compact('cardAtividade', 'idobra', 'obra'));
}
    public function adicionarAtividade(Request $request)
    {
        try {
        //
            //if (Auth::check()) {
             //   $userId = Auth::id();
           // } else{
             //   dd('nao tem usuario logado');
            //}


            $request->validate([
                'nome' => 'required|string',
                'etiqueta.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
                'anexo.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
                'descricao' => 'required|string',
                'dtFinal' => 'required|date',
                'dtInicial' => 'required|date',
                'status' => 'required|in:COMEÇANDO,ANDAMENTO,FINALIZADO',
                'card_atividades_idCard' => 'required|exists:card_atividades,idCard'
            ]);


            $anexosPaths = [];
            $etiquetasPaths = [];
            $idobra = $request->input('idobra');


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
            $userId = Auth::id();
            try {
                $this->associarUsuarioAtividade($Atividades->idAtividade, $userId, $idobra);
            } catch (QueryException $qe) {

                log::error('Erro ao associar usuário à atividade: ' . $qe->getMessage());
            }


            return response()->json(['redirect' => route('Atividade.Listar', ['id' => $idobra])]);
        } catch (\Exception $e) {
            log::error('Erro ao criar atividade: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);

        } catch (QueryException $e) {
            log::error('Erro ao criar atividade: ' . $e->getMessage());
        }
    }





    public function associarUsuarioAtividade($atividadeId, $usuarioId, $idobra)
    {
        {

            if ($atividadeId !== null && $usuarioId !== null) {
                try {


                    DB::table('lista_atividade')->insert([
                        'Atividade_idAtividade' => $atividadeId,
                        'Usuarios_idUsuario' => $usuarioId,
                    ]);



                    return response()->json(['redirect' => route('Atividade.Listar', ['id' => $idobra])]);
                } catch (\Exception $e) {
                    log::error('Erro ao criar atividade: ' . $e->getMessage());
                    return response()->json(['error' => $e->getMessage()], 500);




    }
}
}
}


    public function atualizarAtividade(Request $request, $idAtividade)
    {
        try {


            $atividade = Atividades::findOrFail($idAtividade);

            $request->validate([
                'nomeV' => 'required|string',
                'etiquetaV.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
                'anexoV.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
                'descricaoV' => 'required|string',
                'dtFinalV' => 'required|date',
                'dtInicialV' => 'required|date',
                'statusV' => 'required|in:COMEÇANDO,ANDAMENTO,FINALIZADO',
                'card_atividades_idCardV' => 'required|exists:card_atividades,idCard',
            ]);
            $idobra = $request->input('idobra');
            $anexosPaths = [];
            if ($request->hasFile('anexo')) {
                foreach ($request->file('anexo') as $file) {
                    $anexoPath = $file->store('public/photos/atividade_anexo');
                    $anexoPath = Storage::url($anexoPath);
                    $anexosPaths[] = $anexoPath;
                }
            }
            $etiquetasPaths = [];
            if ($request->hasFile('etiqueta')) {
                foreach ($request->file('etiqueta') as $file) {
                    $etiquetaPath = $file->store('public/photos/atividade_etiqueta');
                    $etiquetaPath = Storage::url($etiquetaPath);
                    $etiquetasPaths[] = $etiquetaPath;
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



            return response()->json(['redirect' => route('Atividade.Listar', ['id' => $idobra])]);
        } catch (\Exception $e) {
            log::error('Erro ao criar atividade: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (QueryException $e) {
            Log::error('Erro ao atualizar atividade: ' . $e->getMessage(), ['atividade_id' => $idAtividade]);
        }
    }






    public function delete_atv($idAtividade,$idobra)
    {
        try {

            DB::table('lista_atividade')->where('Atividade_idAtividade', $idAtividade)->delete();
            Atividades::findOrFail($idAtividade)->delete();

            return response()->json(['redirect' => route('Atividade.Listar', ['id' => $idobra])]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
