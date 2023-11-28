<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Services\ExceptionHandlerService;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Services\UserService;


class UsuariosController extends Controller
{
    protected $userService;
    protected $exceptionHandler;

    //injeção de dependencia
    public function __construct(UserService $userService,  ExceptionHandlerService $exceptionHandler)
    {
        $this->userService = $userService;
        $this->exceptionHandler = $exceptionHandler;
    }

    public function store(Request $request)
    {
        //Validação
       $this->validaçãoUsuario($request);

        try {
        //Criando Usuario
        $usuario = $this->userService->criarUsuario($request);

        } catch (\Exception $e) {
        $errorMessage = $e->getMessage();  // Isso imprimir a mensagem da exceção
        return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
        }

        return redirect()->back()->with('success','Usuario Cadastrado com Sucesso!');

    }

    public function update(Request $request, $id)
    {
        try {
        $usuario = $this->userService->buscarUsuarioPorId($id);

        // Validação dos dados
        //$this->validaçãoUpdateUsuario($request, $usuario);

        $this->userService->atualizarUsuario($usuario,$request);

        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
        }

        return redirect()->back()->with('success','Usuario Atualizado com Sucesso!');

    }

    public function destroy($idUsuario)
    {
        // Encontra o usuário pelo ID
        try {

         $this->userService->DeletarUsuario($idUsuario);

        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
        if($errorCode == 10){
            return redirect()->back()->with(['error' => $errorMessage, 'confirm' => true]);
        }else{
            return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
           }
        }
        return redirect()->route('usuarios.lista')->with('success','Usuario deletado com Sucesso!');
    }


    //Funções Auxiliares
    private function validaçãoUsuario($request)
    {
        $validacao = $request->validate([
            'atribuicao' => ['required', 'exists:roles,id'],
            'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
            'Superior_idUsuario' => ['nullable'],
            'name' => ['required', 'string'],
            'password' => ['nullable'],
            'lastName' => ['required', 'string'],
            'genero' => ['required', 'in:Masculino,Feminino'],
            'cep' => ['required', 'string'],
            'cpf' => ['required', 'string', 'unique:usuarios,cpf'],
            'pais' => ['required', 'string'],
            'cidade' => ['required', 'string'],
            'estado' => ['required', 'string'],
            'email' => ['required', 'email','unique:usuarios,email'],
            'telefone1' => ['required', 'string', 'unique:telefone_usuarios,telefone'],
            'telefone2' => ['nullable', 'string', 'unique:telefone_usuarios,telefone'],
            'telefone3' => ['nullable', 'string', 'unique:telefone_usuarios,telefone'],
        ],[
            'atribuicao_Usuario_id_Atribuicao.required'=>'o campo atribuicão é obrigatorio',
            'name.required'=>'O nome é obrigatório',
            'lastName.required'=>'O sobrenome é obrigatório',
            'genero.required'=>'Por favor, selecione um gênero válido.',
            'cep.required'=>'O campo CEP é obrigatório',
            'cpf.required'=>'O campo CPF é obrigatório',
            'pais.required'=>'Seu endereço é obrigatório',
            'cidade.required'=>'Seu endereço é obrigatório',
            'estado.required'=>'Seu endereço é obrigatório',
            'email.required'=>'Seu email é obrigatório',
            'telefone1.required'=>'Seu telefone é obrigatório',
            'atribuicao_Usuario_id_Atribuicao.exists' => 'Algo de estranho ocorreu durante seu registro, consulte o suporte CODIGO ERRO: 1002#',
            'Estoque_idEstoque.exists' => 'Algo de estranho ocorreu durante seu registro, consulte o suporte CODIGO ERRO: 1002#',
            'Superior_idUsuario.exists' => 'Codigo do supevisor incorreto ou invalido, por valor selecione um supevisor valido',
            'name.string'=> 'O nome nao deve conter nenhum caráter alem de letras',
            'lastName.string'=> 'O sobrenome nao deve conter nenhum caráter alem de letras',
            'genero.in'=>'Por favor, selecione um gênero válido.',
            'pais.string' => 'Por favor, Digite um endereço Valido',
            'cidade.string' => 'Por favor, Digite um endereço Valido',
            'estado.string' => 'Por favor, Digite um endereço Valido',
            'email.email' => 'Por favor, Digite endereço de Email Valido',
            'telefone1.unique' => 'Esse telefone já está em uso ou é invalido',
            'telefone2.unique' => 'Esse telefone já está em uso ou é invalido',
            'telefone3.unique' => 'Esse telefone já está em uso ou é invalido',
            'cpf.unique'=>'Cpf já está em uso ou é invalido',
            'email.unique'=>'Email ja registrado ou invalido'
        ]);
    }

    private function validaçãoUpdateUsuario($request, $usuario)
    {

        //'campo' => ['regras', 'unique:tabela,coluna,exceto,idDoRegistro']

        $validacao = $request->validate([
            'atribuicao_Usuario_id_Atribuicao' => ['required', 'exists:atribuicao_usuario,id_atribuicao'],
            'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
            'Superior_idUsuario' => ['nullable'],
            'name' => ['required', 'string'],
            'password' => ['nullable'],
            'lastName' => ['required', 'string'],
            'genero' => ['required', 'in:Masculino,Feminino'],
            'cep' => ['required', 'string'],
            'cpf' => ['required', 'string', Rule::unique('usuarios', 'cpf')->ignore($usuario->idUsuario, 'idUsuario')],
            'pais' => ['required', 'string'],
            'cidade' => ['required', 'string'],
            'estado' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('usuarios', 'email')->ignore($usuario->idUsuario, 'idUsuario')],
            'telefone1' => ['required', 'string', Rule::unique('telefone_usuarios','telefone')->ignore($usuario->idUsuario, 'Usuarios_idUsuario')],
            'telefone1' => ['required', 'string', Rule::unique('telefone_usuarios','telefone')->ignore($usuario->idUsuario, 'Usuarios_idUsuario')],
            'telefone1' => ['required', 'string', Rule::unique('telefone_usuarios','telefone')->ignore($usuario->idUsuario, 'Usuarios_idUsuario')],
        ],[
            'atribuicao_Usuario_id_Atribuicao.required'=>'o campo atribuicão é obrigatorio',
            'name.required'=>'O nome é obrigatório',
            'lastName.required'=>'O sobrenome é obrigatório',
            'genero.required'=>'Por favor, selecione um gênero válido.',
            'cep.required'=>'O campo CEP é obrigatório',
            'cpf.required'=>'O campo CPF é obrigatório',
            'pais.required'=>'Seu endereço é obrigatório',
            'cidade.required'=>'Seu endereço é obrigatório',
            'estado.required'=>'Seu endereço é obrigatório',
            'email.required'=>'Seu email é obrigatório',
            'telefone1.required'=>'Seu telefone é obrigatório',
            'atribuicao_Usuario_id_Atribuicao.exists' => 'Algo de estranho ocorreu durante seu registro, consulte o suporte CODIGO ERRO: 1002#',
            'Estoque_idEstoque.exists' => 'Algo de estranho ocorreu durante seu registro, consulte o suporte CODIGO ERRO: 1002#',
            'Superior_idUsuario.exists' => 'Codigo do supevisor incorreto ou invalido, por valor selecione um supevisor valido',
            'name.string'=> 'O nome nao deve conter nenhum caráter alem de letras',
            'lastName.string'=> 'O sobrenome nao deve conter nenhum caráter alem de letras',
            'genero.in'=>'Por favor, selecione um gênero válido.',
            'pais.string' => 'Por favor, Digite um endereço Valido',
            'cidade.string' => 'Por favor, Digite um endereço Valido',
            'estado.string' => 'Por favor, Digite um endereço Valido',
            'email.email' => 'Por favor, Digite endereço de Email Valido',
            'telefone1.unique' => 'Esse telefone já está em uso ou é invalido',
            'telefone2.unique' => 'Esse telefone já está em uso ou é invalido',
            'telefone3.unique' => 'Esse telefone já está em uso ou é invalido',
            'cpf.unique'=>'Cpf já está em uso ou é invalido',
            'email.unique'=>'Email ja registrado ou invalido'
        ]);
    }



}
/*
  }else{
    // Criando registros de telefone associados ao usuário
   foreach ($telefonesRequisicao as $telefone) {
   $usuario->telefones()->create(['telefone' => $telefone]);
    }

 if($condicional == 1){
            if(!$idObra){
                return redirect()->back()->with('error', 'Ocorreu um erro nao esperado, por favor consulte o suporte');
            }
            $AssociacaoController = new ListaObrasController();
            $AssociacaoController->desassociarUsuario($idObra,$idUsuario);
        }

*/

 /* Explicando Validação de formato de uma string:
        regex:^\d{3}\.\d{3}\.\d{3}-\d{2}$/
        regex: Padrao da string
        ^ inicio da sequencia
        \ representa uma parte da sequencia seguida de um valor
        \d representar os numeros de 0 a 9
        d{3} representar a quantidade de numeros nessa sequencia
        . representar um ponto
        - representar um traço
        $ representar o fim da sequencia
        'regex:/^\d{5}-\d{3}$/'
        'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'
        */
