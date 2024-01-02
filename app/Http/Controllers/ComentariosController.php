<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Comentario_Criar_Service;
use App\Services\Comentario_Deletar_Service;
use App\Services\Comentario_Validar_Service;

class ComentariosController extends Controller
{
    protected $Comentario_Criar_Service;
    protected $Comentario_Deletar_Service;
    protected $Comentario_Validar_Service;

    //injeção de dependencia
    public function __construct(
        Comentario_Criar_Service $Comentario_Criar_Service,
        Comentario_Deletar_Service $Comentario_Deletar_Service,
        Comentario_Validar_Service $Comentario_Validar_Service)
    {
        $this->Comentario_Criar_Service = $Comentario_Criar_Service;
        $this->Comentario_Deletar_Service = $Comentario_Deletar_Service;
        $this->Comentario_Validar_Service = $Comentario_Validar_Service;
    }
    
    public function criarComentarios(Request $request, $idAtividade, $idUsuario)
    {
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
