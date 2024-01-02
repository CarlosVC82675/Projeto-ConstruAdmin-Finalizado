<?php

namespace App\Services;
use Illuminate\Http\Request;
class Comentario_Validar_Service{


public function ValidarComentario(Request $request){

    $request->validate([
        'comentario' => 'required|string',
        'Usuarios_idUsuario' => 'required|exists:usuarios,idUsuario',
        'Atividade_idAtividade' => 'required|exists:atividade,idAtividade',
    ]);

}


}


?>