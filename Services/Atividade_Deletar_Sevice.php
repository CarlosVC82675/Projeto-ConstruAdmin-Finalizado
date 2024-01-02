<?php  



namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\Atividades;


class Atividade_Deletar_Sevice{


    public function delete_atv($idAtividade){
        DB::table('lista_atividade')->where('Atividade_idAtividade', $idAtividade)->delete();
        Atividades::findOrFail($idAtividade)->delete();


    }

}


?>