<?php

namespace App\Http\Controllers;


use App\Services\ExceptionHandlerService;
use Illuminate\Http\Request;
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
        if($this->userService->VerificarPermissao('Usuario')){
            //Validação
            $this->validaçãoUsuario($request);
            try {
            //Criando Usuario
            $this->userService->criarUsuario($request);
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Isso obtém a mensagem da exceção
                $errorCode = $e->getCode(); // Isso obtém o código da exceção

                $errorData = [
                    'message' => $errorMessage ?? 'Erro desconhecido.',
                    'code' => $errorCode ?? 'Desconhecido'
                ];
                return redirect()->back()->with('error', $errorData)->withInput();
            }
            return redirect()->back()->with('success','Usuario Cadastrado com Sucesso!');
        }else{
            return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
        }
    }

    public function update(Request $request, $id)
    {
        if($this->userService->VerificarPermissao('Usuario')){
            try {
            $usuario = $this->userService->buscarUsuarioPorId($id);

            // Validação dos dados
            $this->validaçãoUpdateUsuario($request, $usuario);

            $this->userService->atualizarUsuario($usuario,$request);

            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Isso obtém a mensagem da exceção
                $errorCode = $e->getCode(); // Isso obtém o código da exceção

                $errorData = [
                    'message' => $errorMessage ?? 'Erro desconhecido.',
                    'code' => $errorCode ?? 'Desconhecido'
                ];

                return redirect()->back()->with('error', $errorData)->withInput();
            }

            return redirect()->back()->with('success','Usuario Atualizado com Sucesso!');
        }else{
            return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
        }
    }

    public function destroy($idUsuario)
    {
       if($this->userService->VerificarPermissao('Usuario')){
            // Encontra o usuário pelo ID
            try {

            $this->userService->deletarUsuario($idUsuario);

            } catch (\Exception $e) {
                $errorMessage = $e->getMessage();
                $errorCode = $e->getCode();

            if($errorCode == 10){
                return redirect()->back()->with(['error' => $errorMessage, 'confirm' => true]);
            }else{
                $errorMessage = $e->getMessage();
                $errorCode = $e->getCode();

                $errorData = [
                    'message' => $errorMessage ?? 'Erro desconhecido.',
                    'code' => $errorCode ?? 'Desconhecido'
                ];

                return redirect()->back()->with('error', $errorData);
            }
            }
            return redirect()->route('usuarios.lista')->with('success','Usuario deletado com Sucesso!');
        }else{
            return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
        }
    }


    //Funções Auxiliares
    private function validaçãoUsuario($request)
    {
        $validacao = $request->validate([
            'atribuicao' => ['required', 'exists:roles,id'],
            'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
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
            'atribuicao.required'=>'o campo atribuicão é obrigatorio',
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
            'atribuicao' => ['required'],
            'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
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
            'atribuicao.required'=>'o campo atribuicão é obrigatorio',
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
