<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\CardAtividade_Criar_Service;
use App\Services\CardAtividade_Deletar_Service;
use App\Services\CardAtividade_Validar_Service;
use App\Services\UserService;


class CardAtividadesController extends Controller
{

    protected $CardAtividade_Criar_Service;
    protected $CardAtividade_Validar_Service;
protected $CardAtividade_Deletar_Service;
protected $userService;
    //injeção de dependencia
    public function __construct(
        UserService $userService,
        CardAtividade_Criar_Service $CardAtividade_Criar_Service,
    CardAtividade_Validar_Service $CardAtividade_Validar_Service,
    CardAtividade_Deletar_Service $CardAtividade_Deletar_Service)
    {
        $this->CardAtividade_Criar_Service = $CardAtividade_Criar_Service;
        $this->CardAtividade_Validar_Service = $CardAtividade_Validar_Service;
        $this->CardAtividade_Deletar_Service = $CardAtividade_Deletar_Service;
        $this->userService = $userService;
    }

    public function criar_card(Request $request)
    {
        if (!$this->userService->VerificarPermissao('Atividade')) {
            // Caso não tenha permissão (Controle de Acesso)
            return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
        }

        try {

$this->CardAtividade_Validar_Service->ValidarCard($request);
$this->CardAtividade_Criar_Service->criar_card($request);

            return redirect()->route('Atividade.Kanban');

        } catch (\Exception $e) {
            // Trate os erros aqui

            // Log para verificar se há erros durante a execução
            Log::error('Erro ao criar o card de atividade: ' . $e->getMessage());

            return redirect()->back()->with('error_var', 'Erro ao criar o card de atividade: ' . $e->getMessage());
        }
    }


    public function deleteCard($idCard,$idobra)
    {
        if (!$this->userService->VerificarPermissao('Atividade')) {
            // Caso não tenha permissão (Controle de Acesso)
            return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
        }
        
        try {

$this->CardAtividade_Deletar_Service->deleteCard($idCard);

            return response()->json(['redirect' => route('Atividade.Listar', ['id' => $idobra])]);
        } catch (\Exception $e) {
            // Lidar com erros, registrar logs, etc.
            Log::error('Erro ao procurar card ou apagar o card: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao excluir card e atividades'], 500);
        }
    }

}
