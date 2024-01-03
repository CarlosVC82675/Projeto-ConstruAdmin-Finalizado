<?php 

namespace App\Services;

use Illuminate\Http\Request;
class Atividade_Validar_Service{


public function Validar(Request $request){

$request->validate([
    'nome' => 'required|string',
    'etiqueta.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
    'anexo.*' => 'required|mimes:png,jpg,jpeg,application/pdf,docx',
    'descricao' => 'required|string',
    'dtFinal' => 'required|date',
    'dtInicial' => 'required|date',
    'status' => 'required|in:COMEÇANDO,ANDAMENTO,FINALIZADO',
    'card_atividades_idCard' => 'required|exists:card_atividades,idCard'
],[
    'nome.required'=>'Por favor preencha o nome da atividade',
    'etiqueta.*.required' => 'Por favor preencha o campo da etiqueta',
    'anexo.*.required' => 'Por favor preecha o campo do anexo',
    'descricao.required'=>'Por favor preencha o campo da descrição',
    'dtFinal.required'=>'Por favor preencha o campo da data final',
    'dtInicial.required'=>'Por favor preecha o campo da dara Inicial',
    'status.required'=>'Por favor preencha o campo dos status',
    'card_atividades_idCard.required'=>'Por favor informe o id do card'

]);


}



}

?>