<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComentariosController extends Controller
{
    
    public function criarComentarios(Request $request, $idAtividade, $idUsuario)
    {

        $request->validate([
            'comentario' => 'required|string',
            'Usuarios_idUsuario' => 'required|exists:usuarios,idUsuario', 
            'Atividade_idAtividade' => 'required|exists:atividade,idAtividade',
        ]);
    
        try {
            $comentario = Comentarios::create([
                'comentario' => $request->input('comentario'),
                'Usuarios_idUsuario' => $idUsuario,
                'Atividade_idAtividade' => $idAtividade,
            ]);
    
            // Pode ser útil retornar alguma resposta, por exemplo, o ID do comentário criado
            return response()->json(['idComentario' => $comentario->idComentario], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // Tratar erro e retornar uma resposta apropriada
            return response()->json(['error' => 'Erro ao criar o comentário no controller'], 500);
        }
    }
    




}
