<?php  

namespace App\Services;
use Illuminate\Http\Request;


class CardAtividade_Validar_Service{

public function ValidarCard(Request $request){

    $request->validate([
        'titulo' => 'required|string',
        'Obras_idObras' => 'required|exists:obras,idObras',

    ],
[  'titulo.required'=>'Titulo do card e necessario',
'Obras_idObras.required|exists:obras,idObras'=>'Id da obra é necessario']



);


}




}



?>