<?php  


namespace App\Services;
use App\Models\card_atividades;

class CardAtividade_Deletar_Service{




public function deleteCard($idCard)
    {
     
            $card = card_atividades::findOrFail($idCard);

            $atividades = $card->atividade;


            foreach ($atividades as $atividade) {

                $atividade->usuarios()->detach();
            }


            $card->atividade()->delete();


            $card->delete();


}
    }



?>