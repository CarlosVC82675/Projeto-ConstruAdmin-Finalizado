<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use App\Models\card_atividades;
use App\Models\Obras;
use App\Services\Atividade_Associar_Service;
use App\Services\Atividade_Validar_Service;
use App\Services\Atividade_Validar_Service_to_Update;
use App\Services\Atividade_Criar_Service;
use App\Services\Atividade_Procurar_Service;
use App\Services\Atividade_Atualizar_Service;
use App\Services\Atividade_Deletar_Sevice;



class AtividadesController extends Controller
{

 

    protected $Atividade_Associar_Service;

    protected $Atividade_Validar_Service;

    protected $Atividade_Validar_Service_to_Update;

    protected $Atividade_Criar_Service;

    protected $Atividade_Procurar_Service;

    protected $Atividade_Atualizar_Service;

    protected $Atividade_Deletar_Sevice;

    
    
    //injeção de dependencia
      public function __construct(
         Atividade_Associar_service $Atividade_Associar_Service, 
         Atividade_Validar_Service $Atividade_Validar_Service, 
         Atividade_Criar_Service $Atividade_Criar_Service,
         Atividade_Procurar_Service $Atividade_Procurar_Service,
          Atividade_Atualizar_Service $Atividade_Atualizar_Service,
           Atividade_Validar_Service_to_Update $Atividade_Validar_Service_to_Update, Atividade_Deletar_Sevice $Atividade_Deletar_Sevice)
    {
$this->Atividade_Associar_Service= $Atividade_Associar_Service;
$this->Atividade_Validar_Service = $Atividade_Validar_Service;
$this->Atividade_Validar_Service_to_Update = $Atividade_Validar_Service_to_Update;
$this->Atividade_Criar_Service = $Atividade_Criar_Service;
$this->Atividade_Procurar_Service=$Atividade_Procurar_Service;
$this->Atividade_Atualizar_Service=$Atividade_Atualizar_Service;
$this->Atividade_Deletar_Sevice=$Atividade_Deletar_Sevice;
    }

    public function Listar_ATV_Obra($idobra)
{
   $obra = Obras::find($idobra);
   $cardAtividade = $this->Atividade_Procurar_Service->GetAllCards($idobra);
   return view('site.siteObra.atividade.Lista_Atividade', compact('cardAtividade', 'idobra', 'obra'));
}

public function Relatorio_ATV($idobra)
{
    try{

        $obra = Obras::find($idobra);
$atividades = $this->Atividade_Procurar_Service->GetAllAtividades($idobra);
return view('site.siteObra.atividade.Relatorio',compact('atividades','obra'));

} catch (\Exception $e) {
    log::error('Erro ao criar atividade: ' . $e->getMessage());
    return response()->json(['error' => $e->getMessage()], 500);}
}

public function Lista_Funcionario($idobra)
{
    try{

        $obra = Obras::find($idobra);
$Usuarios = $this->Atividade_Procurar_Service->GetAllUser_WithAtv ($idobra);


return view('site.siteObra.atividade.Lista_Funcionarios',compact('Usuarios','obra'));

} catch (\Exception $e) {
    log::error('Erro ao criar atividade: ' . $e->getMessage());
    return response()->json(['error' => $e->getMessage()], 500);}
}
public function Lista_Responsaveis($idobra)
{
    try{

        $obra = Obras::find($idobra);
$Usuarios = $this->Atividade_Procurar_Service->GetAllUser_WithAtv ($idobra);


return view('site.siteObra.atividade.Lista_Responsavei',compact('Usuarios','obra'));

} catch (\Exception $e) {
    log::error('Erro ao criar atividade: ' . $e->getMessage());
    return response()->json(['error' => $e->getMessage()], 500);}
}




    public function adicionarAtividade(Request $request)
    {
        try {
            $userId = Auth::id();
            $idobra = $request->input('idobra');


$this->Atividade_Validar_Service->Validar($request);
$idAtividade = $this->Atividade_Criar_Service->adicionarAtividade($request);
$this->Atividade_Associar_Service->Associar($idAtividade, $userId);

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
        try{

            $this->Atividade_Associar_Service->Associar($atividadeId, $usuarioId);

                    return response()->json(['redirect' => route('Atividade.Listar', ['id' => $idobra])]);
                } catch (\Exception $e) {
                    log::error('Erro ao criar atividade: ' . $e->getMessage());
                    return response()->json(['error' => $e->getMessage()], 500);}
                }

    public function atualizarAtividade(Request $request, $idAtividade)
    {
        try {


            $this->Atividade_Validar_Service_to_Update->Validar($request);

            $idobra = $request->input('idobra');


            $atividade= $this->Atividade_Procurar_Service->findAtividade($idAtividade);
            $this->Atividade_Atualizar_Service->atualizarAtividade($request, $atividade);
         

        
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

            $this->Atividade_Deletar_Sevice->delete_atv($idAtividade);

            return response()->json(['redirect' => route('Atividade.Listar', ['id' => $idobra])]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
