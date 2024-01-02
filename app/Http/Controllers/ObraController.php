<?php
//Feito por diego

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obras;
use App\Services\ExceptionHandlerService;
use App\Services\ObraService;
use Illuminate\Validation\Rule;
use App\Services\UserService;

class ObraController extends Controller
{
    protected $ObraService;
    protected $exceptionHandler;
    protected $userService;

    public function __construct(UserService $userService,ObraService $ObraService,  ExceptionHandlerService $exceptionHandler)
    {
        $this->userService = $userService;
        $this->ObraService = $ObraService;
        $this->exceptionHandler = $exceptionHandler;
    }


    // Salva uma obra no banco de dados
    public function store(Request $request)
    {
    if($this->userService->VerificarPermissao('Obrafora')){

        $this->validarCadastro($request);

        try {
            $this->ObraService->cadastrarObra($request);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();  // Isso imprimir a mensagem da exceção
            return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }

    }


    // Atualizar uma Obra
    public function update(Request $request, $id)
    {
    if($this->userService->VerificarPermissao('Obrafora')){
        try {
            $obra = $this->ObraService->buscarObraId($id);

            $this->validarUpdate($request, $id);

            $this->ObraService->atualizarObra($request, $obra);

            return redirect()->route('site.index', ['id' => $id]);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();  // Isso imprimir a mensagem da exceção
            return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }

    }


    // Desativa uma obra pelo id
    public function desativar($id)
    {
    if($this->userService->VerificarPermissao('Obrafora')){
        try {
            $obra = $this->ObraService->buscarObraId($id);

            $this->ObraService->desativar($obra);

            return redirect()->route('site.index');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();  // Isso imprimir a mensagem da exceção
            return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }

    }


    //Funções auxiliares
    public function validarCadastro(Request $request)
    {

        $request->validate([

            'nome' => ['required', 'string', 'unique:obras,nome', 'max:50'],
            'status' => ['required', 'in:Andamento,Finalizado'],
            'descricao' => ['required', 'string'],
            'tamanho' => ['required', 'string', 'regex:/^\d+(\,\d{2})?$/'],
            'tipo' => ['required', 'in:Residencial,Comercial,Industrial,Infraestrutura,Saneamento,Restauro'],
            'logradouro' => ['required', 'string', 'max:100', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'numResidencial' => ['max:100'],
            'bairro' => ['required', 'string', 'max:100', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'cidade' => ['required', 'string', 'max:80', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'estado' => ['required', 'string', 'max:80', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'cep' => ['required', 'string', 'regex:/^\d{5}-\d{3}$/'],
            'estrutura' => ['required', 'in:Metálica,Concreto,Madeira'],
            'proposito' => ['required', 'string'],
            'dtInicial' => ['required', 'date'],
            'dtFinal' => ['required', 'date'],

        ], [
            'nome.max' => 'O limite de caracteres para Nome é 50',
            'nome.unique' => 'Esse nome já existe, tente outro',
            'tamanho.regex' => 'Formato invalido no Tamanho, use numeros positivos',
            'logradouro.max' => 'O limite de caracteres para Logradouro é 100',
            'logradouro.regex' => 'Formato invalido no Logradouro, use apenas letras',
            'numResidencial.max' => 'O limite de caracteres para Número Residencial é 100',
            'bairro.max' => 'O limite de caracteres para bairro é 100',
            'cidade.max' => 'O limite de caracteres para cidade é 80',
            'estado.max' => 'O limite de caracteres para estado é 80',
            'bairro.regex' => 'Formato invalido no Bairro, use apenas letras',
            'cidade.regex' => 'Formato invalido na Cidade, use apenas letras',
            'estado.regex' => 'Formato invalido no Estado, use apenas letras',
            'cep.regex' => 'Formato invalido no CEP, use o formato xxxxx-xxx',

            'nome.required' => 'Preencha o campo Nome',
            'status.required' => 'Preencha o campo Status',
            'descricao.required' => 'Preencha o campo Descrição',
            'tamanho.required' => 'Preencha o campo Tamanho',
            'tipo.required' => 'Preencha o campo Tipo',
            'logradouro.required' => 'Preencha o campo Logradouro',
            'bairro.required' => 'Preencha o campo Bairro',
            'cidade.required' => 'Preencha o campo Cidade',
            'estado.required' => 'Preencha o campo Estado',
            'cep.required' => 'Preencha o campo CEP',
            'estrutura.required' => 'Preencha o campo Estrutura',
            'proposito.required' => 'Preencha o campo Proposito',
            'dtInicial.required' => 'Preencha o campo Data Inicial',
            'dtFinal.required' => 'Preencha o campo Data Final'



        ]);
    }

    public function validarUpdate(Request $request, $id)
    {
        $obra = Obras::find($id);
        $request->validate(
            [

                'nome' => ['required', 'string', 'max:50', Rule::unique('obras', 'nome')->ignore($obra->idObras, 'idObras')],
                'status' => ['required', 'in:Andamento,Finalizado'],
                'descricao' => ['required', 'string'],
                'tamanho' => ['required', 'string', 'regex:/^\d+(\,\d{2})?$/'],
                'tipo' => ['in:Residencial,Comercial,Industrial,Infraestrutura,Saneamento,Restauro'],
                'logradouro' => ['required', 'string', 'max:100', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
                'numResidencial' => ['max:100'],
                'bairro' => ['required', 'string', 'max:100', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
                'cidade' => ['required', 'string', 'max:80', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
                'estado' => ['required', 'string', 'max:80', 'regex:/^[a-zA-ZÀ-ú\s]+$/'],
                'cep' => ['required', 'string', 'regex:/^\d{5}-\d{3}$/'],
                'estrutura' => ['in:Metálica,Concreto,Madeira'],
                'proposito' => ['required', 'string'],
                'dtInicial' => ['required', 'date'],
                'dtFinal' => ['required', 'date']
            ],
            [
                'nome.max' => 'O limite de caracteres para Nome é 50',
                'nome.unique' => 'Esse nome já existe, tente outro',
                'tamanho.regex' => 'Formato invalido no Tamanho, use numeros positivos',
                'logradouro.max' => 'O limite de caracteres para Logradouro é 100',
                'logradouro.regex' => 'Formato invalido no Logradouro, use apenas letras',
                'numResidencial.max' => 'O limite de caracteres para Número Residencial é 100',
                'numResidencial.regex' => 'Formato invalido no Número Residencial, use números positivos com até duas casas decimais',
                'bairro.max' => 'O limite de caracteres para bairro é 100',
                'cidade.max' => 'O limite de caracteres para cidade é 80',
                'estado.max' => 'O limite de caracteres para estado é 80',
                'bairro.regex' => 'Formato invalido no Bairro, use apenas letras',
                'cidade.regex' => 'Formato invalido na Cidade, use apenas letras',
                'estado.regex' => 'Formato invalido no Estado, use apenas letras',
                'cep.regex' => 'Formato invalido no CEP, use o formato xxxxx-xxx',

                'nome.required' => 'Preencha o campo Nome',
                'status.required' => 'Preencha o campo Status',
                'descricao.required' => 'Preencha o campo Descrição',
                'tamanho.required' => 'Preencha o campo Tamanho',
                'tipo.required' => 'Preencha o campo Tipo',
                'logradouro.required' => 'Preencha o campo Logradouro',
                'bairro.required' => 'Preencha o campo Bairro',
                'cidade.required' => 'Preencha o campo Cidade',
                'estado.required' => 'Preencha o campo Estado',
                'cep.required' => 'Preencha o campo CEP',
                'estrutura.required' => 'Preencha o campo Estrutura',
                'proposito.required' => 'Preencha o campo Proposito',
                'dtInicial.required' => 'Preencha o campo Data Inicial',
                'dtFinal.required' => 'Preencha o campo Data Final',



            ]
        );
    }
}
