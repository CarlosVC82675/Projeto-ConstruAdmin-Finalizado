<?php

namespace App\Http\Controllers;

use App\Models\card_atividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\UserService;

class CardAtividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Show the form for creating a new resource.
     */
    protected $userService;

    //injeção de dependencia
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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

            return redirect()->back()->with('error_var', 'Erro ao criar o card de atividade: ' . $e->getMessage());
        }
    }


    public function deleteCard($idCard,$idobra)
    {
        try {
            $card = card_atividades::findOrFail($idCard);

            $atividades = $card->atividade;


            foreach ($atividades as $atividade) {

                $atividade->usuarios()->detach();
            }


            $card->atividade()->delete();


            $card->delete();


            return response()->json(['redirect' => route('Atividade.Listar', ['id' => $idobra])]);
        } catch (\Exception $e) {
            // Lidar com erros, registrar logs, etc.
            Log::error('Erro ao procurar card ou apagar o card: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao excluir card e atividades'], 500);
        }
    }

}
