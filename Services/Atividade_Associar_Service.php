<?php 
namespace App\Services;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;





class Atividade_Associar_Service{


public function Associar($atividadeId, $usuarioId){

if ($atividadeId !== null && $usuarioId !== null) {
    try {
        DB::table('lista_atividade')->insert([
            'Atividade_idAtividade' => $atividadeId,
            'Usuarios_idUsuario' => $usuarioId,
        ]);


    } catch (\Exception $e) {
        log::error('Erro ao Associar ' . $e->getMessage());
}

}else{
    log::error('algum id esta nulo'.'Atividade:'.$atividadeId,$usuarioId);
}


}
}


?>