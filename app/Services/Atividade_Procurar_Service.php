<?php  

namespace App\Services;

use App\Models\Atividades;
use App\Models\card_atividades;
use App\Models\Usuario;

class Atividade_Procurar_Service{



    public function findAtividade($idAtividade){

        $atividade = Atividades::findOrFail($idAtividade);
        return $atividade;
}

public function GetAllAtividades($idobra){
    $atividades = card_atividades::where('Obras_idObras', $idobra)
    ->with('atividade')->get();
    return $atividades;
 }

 public function GetAllCards($idobra){
    $cardAtividade = card_atividades::where('Obras_idObras', $idobra)
    ->with([
        'atividade' => function ($query) {
            $query->with(['usuarios.roles', 'usuarios.Comentarios']);
        }
    ])
    ->get();
    return $cardAtividade;
 }

 public function GetAllUser_WithAtv($idobra){

    $usuarios = Usuario::whereHas('atividades', function ($query) use ($idobra) {
        $query->whereHas('card', function ($query) use ($idobra) {
            $query->where('Obras_idObras', $idobra);
        });
    })->with(['atividades' => function ($query) use ($idobra) {
        $query->whereHas('card', function ($query) use ($idobra) {
            $query->where('Obras_idObras', $idobra);
        });
    }])->get();
    

return $usuarios;



 }



}



?>