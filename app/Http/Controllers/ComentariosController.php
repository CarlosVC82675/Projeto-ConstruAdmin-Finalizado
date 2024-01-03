<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Comentario_Criar_Service;
use App\Services\Comentario_Deletar_Service;
use App\Services\Comentario_Validar_Service;
use App\Services\UserService;


class ComentariosController extends Controller
{
    protected $userService;
    protected $Comentario_Criar_Service;
    protected $Comentario_Deletar_Service;
    protected $Comentario_Validar_Service;

    //injeção de dependencia
    public function __construct(
        UserService $userService,
        Comentario_Criar_Service $Comentario_Criar_Service,
        Comentario_Deletar_Service $Comentario_Deletar_Service,
        Comentario_Validar_Service $Comentario_Validar_Service)
    {
        $this->Comentario_Criar_Service = $Comentario_Criar_Service;
        $this->Comentario_Deletar_Service = $Comentario_Deletar_Service;
        $this->Comentario_Validar_Service = $Comentario_Validar_Service;
        $this->userService = $userService;
    }

    public function criarComentarios(Request $request, $idAtividade, $idUsuario)
    {
        if (!$this->userService->VerificarPermissao('Atividade')) {
            // Caso não tenha permissão (Controle de Acesso)
            return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
        }

        try {

            $this->Comentario_Validar_Service->ValidarComentario($request);
            $this->Comentario_Criar_Service->criarComentarios($request, $idAtividade, $idUsuario);

            return response()->json();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Erro ao criar o comentário no controller'], 500);
        }


    }



    public function DeletarComentario($idComentario){

        if (!$this->userService->VerificarPermissao('Atividade')) {
            // Caso não tenha permissão (Controle de Acesso)
            return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
        }

        try {


            $this->Comentario_Deletar_Service->DeletarComentario($idComentario);


            // Pode ser útil retornar alguma resposta, por exemplo, o ID do comentário criado
            return response()->json();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // Tratar erro e retornar uma resposta apropriada
            return response()->json(['error' => 'Erro ao Deletar o comentário no controller'], 500);
        }

    }





}
