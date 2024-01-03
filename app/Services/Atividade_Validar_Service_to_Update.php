<?php  

namespace App\Services;

use Illuminate\Http\Request;
class Atividade_Validar_Service_to_Update{


public function Validar(Request $request){

$request->validate([
    'nomeV' => 'required|string',
    'etiquetaV.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
    'anexoV.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
    'descricaoV' => 'required|string',
    'dtFinalV' => 'required|date',
    'dtInicialV' => 'required|date',
    'statusV' => 'required|in:COMEÇANDO,ANDAMENTO,FINALIZADO',
    'card_atividades_idCardV' => 'required|exists:card_atividades,idCard'
],[
    'nomeV.required'=>'Por favor preencha o nome da atividade',
    'etiquetaV.*.required' => 'Por favor preencha o campo da etiqueta',
    'anexoV.*.required' => 'Por favor preecha o campo do anexo',
    'descricaoV.required'=>'Por favor preencha o campo da descrição',
    'dtFinalV.required'=>'Por favor preencha o campo da data final',
    'dtInicialV.required'=>'Por favor preecha o campo da dara Inicial',
    'statusV.required'=>'Por favor preencha o campo dos status',
    'card_atividades_idCardV.required'=>'Por favor informe o id do card'

]);


}



}

?>



