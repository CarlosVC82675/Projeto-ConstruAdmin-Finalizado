<?php  

namespace App\Services;
use App\Models\card_atividades;
use Illuminate\Http\Request;
class CardAtividade_Criar_Service{


    public function criar_card(Request $request)
    {
       

            // Cria o novo card
            card_atividades::create([
                'titulo' => $request->input('titulo'),
                'Obras_idObras' => $request->input('Obras_idObras')
            ]);




}
    
}

?>