<?php

namespace App\Http\Controllers;

use App\Models\card_atividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class CardAtividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function criar_card(Request $request)
    {
        try {
            $request->validate([
                'titulo' => 'required|string',
                'Obras_idObras' => 'required|exists:obras,idObras',
                
            ]);
    
            // Cria o novo card
            card_atividades::create([
                'titulo' => $request->input('titulo'),
                'Obras_idObras' => $request->input('Obras_idObras')
            ]);
    
            // Obtém todos os cards
            $cardAtividade = card_atividades::all();
    
            // Log para verificar se a função está sendo chamada
            Log::info('Função criar_card chamada com sucesso.');
    
            // Log para verificar se há cards após a criação
            Log::info('Número de cards após a criação: ' . count($cardAtividade));
    
            // Adiciona $cardAtividade à sessão
         
    
            // Redireciona para a rota 'Atividade.Lista'
            return redirect()->route('Atividade.Kanban');
    
        } catch (\Exception $e) {
            // Trate os erros aqui
    
            // Log para verificar se há erros durante a execução
            Log::error('Erro ao criar o card de atividade: ' . $e->getMessage());
    
            return redirect()->route('Atividade.Kanban')->with('error_var', 'Erro ao criar o card de atividade: ' . $e->getMessage());
        }
    }


    public function deleteCard($idCard) {
        try {
          
  
$card = card_atividades::findOrFail($idCard);

$atividades = $card->atividade;


foreach ($atividades as $atividade) {
  
    $atividade->usuarios()->detach();
}


$card->atividade()->delete();


$card->delete();
           
          
            return response()->json(['redirect' => route('Atividade.Listar')]);
        } catch (\Exception $e) {
            // Lidar com erros, registrar logs, etc.
            Log::error('Erro ao procurar card ou apagar o card: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao excluir card e atividades'], 500);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(card_atividades $card_atividades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(card_atividades $card_atividades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, card_atividades $card_atividades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(card_atividades $card_atividades)
    {
        //
    }
}
