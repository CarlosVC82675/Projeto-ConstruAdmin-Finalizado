<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Comentarios;
class Comentario_Criar_Service{


public function criarComentarios(Request $request,  $idAtividade, $idUsuario){

  Comentarios::create([
                'comentario' => $request->input('comentario'),
                'Usuarios_idUsuario' => $idUsuario,
                'Atividade_idAtividade' => $idAtividade,
            ]);


}
}


?>