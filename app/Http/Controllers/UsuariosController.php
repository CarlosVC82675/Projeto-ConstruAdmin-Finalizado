<?php

namespace App\Http\Controllers;


use App\Services\ExceptionHandlerService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\UserService;
use App\Mail\CredenciaisEmail;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        //Tecnica de retorno antecipado;

        // Verificação de Permissão (Controle de acesso)
        if (!$this->userService->VerificarPermissao('Usuario')) {
            // Caso não tenha permissão (Controle de Acesso)
            return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
        }
            //Validação de dados(Função auxiliar)
           //  $this->validaçãoUsuario($request);

            try {
            //Criando Usuario(Fluxo Principal)
            $this->userService->criarUsuario($request);


            $usuarioNome = request()->input('name');
            $usuarioEmail = request()->input('email');
            $cpf = request()->input('cpf');
            $cpfSemPontuacao = str_replace(['.', '-'], '', $cpf);
            $senha = $cpfSemPontuacao; // Remove os pontos do CPF

            // Enviar email com as credenciais
            $mail = new CredenciaisEmail($usuarioNome, $usuarioEmail, $senha);
            Mail::to($usuarioEmail)->send($mail);


            } catch (\Exception $e) {
            //Tratamento de Erros(Fluxo altenativo)
                $errorMessage = $e->getMessage(); // pega a mensagem da exceção
                $errorCode = $e->getCode(); // pega o código da exceção
                $errorData = [
                    'message' => $errorMessage ?? 'Erro desconhecido.',
                    'code' => $errorCode ?? 'Desconhecido'
                ];
                //Retornando o Erro(Fluxo altenativo)
                return redirect()->back()->with('error', $errorData)->withInput();
            }
            //Caso esteja tudo Certo, Retornando Com sucesso(Fluxo Principal)
            return redirect()->back()->with('success','Usuario Cadastrado com Sucesso!');
    }

    public function update(Request $request, $id)
    {
        // Verificação de Permissão (Controle de acesso)
        if (!$this->userService->VerificarPermissao('Usuario')) {
         // Caso não tenha permissão (Controle de Acesso)
         return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
        }

        try {
        //Procurando o Usuario(Fluxo Principal)
        $usuario = $this->userService->buscarUsuarioPorId($id);

        //Validação de dados(Função auxiliar)
        $this->validaçãoUpdateUsuario($request, $usuario);

         //Autualizando dados do Usuario(Fluxo Principal)
        $this->userService->atualizarUsuario($usuario,$request);


        } catch (\Exception $e) {
        //Tratamento de Erros(Fluxo altenativo)
            $errorMessage = $e->getMessage(); // pega a mensagem da exceção
            $errorCode = $e->getCode(); // pega o código da exceção
            $errorData = [
            'message' => $errorMessage ?? 'Erro desconhecido.',
            'code' => $errorCode ?? 'Desconhecido'
            ];
             //Retornando o Erro(Fluxo altenativo)
            return redirect()->back()->with('error', $errorData)->withInput();
        }
         //Caso esteja tudo Certo, Retornando Com sucesso(Fluxo Principal)
        return redirect()->back()->with('success','Usuario Atualizado com Sucesso!');
    }

    public function destroy($idUsuario)
    {
      // Verificação de Permissão (Controle de acesso)
      if (!$this->userService->VerificarPermissao('Usuario')) {
        // Caso não tenha permissão (Controle de Acesso)
        return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
       }

        try {
            //deletar o Usuario(Fluxo Principal)
            $this->userService->deletarUsuario($idUsuario);


            } catch (\Exception $e) {
            //Tratamento de Erro(Fluxo altenativo)
            $errorMessage = $e->getMessage(); // pega a mensagem da exceção
            $errorCode = $e->getCode(); // pega o código da exceção
            $errorData = [
            'message' => $errorMessage ?? 'Erro desconhecido.',
            'code' => $errorCode ?? 'Desconhecido'
            ];
            //Tratamento de Erro de chave estrangeira(Fluxo altenativo 1)
            if($errorCode == 10){
            return redirect()->back()->with(['error' => $errorMessage, 'confirm' => true]);
            }else{
            //Retornando outro Erro qualquer(Fluxo altenativo 2)
            return redirect()->back()->with('error', $errorData);
            }
        }
        //Caso esteja tudo Certo, Retornando Com sucesso(Fluxo Principal)
        return redirect()->route('usuarios.lista')->with('success','Usuario deletado com Sucesso!');
    }

    public function redefinirSenha(Request $request)
    {
        $request->validate([
            'novaSenha' => ['required', 'min:10', 'same:confirmacaoSenha', 'regex:/[A-Za-z]/'],
            'confirmacaoSenha' => ['required','same:novaSenha'],
        ],[
            'novaSenha.required' => 'A nova senha é obrigatória.',
            'novaSenha.min' => 'A senha deve ter no mínimo 10 caracteres.',
            'novaSenha.same' => 'As senhas não coincidem.',
            'novaSenha.regex' => 'A senha deve conter pelo menos uma letra.',
            'confirmacaoSenha.required' => 'A confirmação de senha é obrigatória.',
            'confirmacaoSenha.same' => 'As senhas não coincidem.',
        ]);

        try {
            $usuario = Usuario::find(Auth::id());
            // Atualiza a senha se o usuário foi encontrado
            if ($usuario) {
                $novaSenha = $request->input('novaSenha');

                //adição de um "salt" (um valor aleatório único para cada usuário) ao armazenar senhas
                //garante que mesmo que duas senhas sejam iguais, elas resultarão em hashes diferentes.

                $usuario->setAttribute('password', Hash::make($novaSenha));
                $usuario->firstAccess = false;
                $usuario->save();
            }
        } catch (\Exception $e) {
            //Tratamento de Erros(Fluxo altenativo)
                $errorMessage = $e->getMessage(); // pega a mensagem da exceção
                $errorCode = $e->getCode(); // pega o código da exceção
                $errorData = [
                    'message' => $errorMessage ?? 'Erro desconhecido.',
                    'code' => $errorCode ?? 'Desconhecido'
                ];
                //Retornando o Erro(Fluxo altenativo)
                return redirect()->back()->with('error', $errorData)->withInput();
        }
            //Caso esteja tudo Certo, Retornando Com sucesso(Fluxo Principal)
            return redirect()->route('site.index');
    }

    //Funções Auxiliares
    private function validaçãoUsuario($request)
    {
        $request->validate([
            'atribuicao' => ['required', 'exists:roles,id'],
            'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
            'name' => ['required', 'string'],
            'password' => ['nullable'],
            'lastName' => ['required', 'string'],
            'genero' => ['required', 'in:MASCULINO,FEMININO'],
            'cep' => ['required', 'string', 'regex:/^\d{5}-\d{3}$/'],
            'cpf' => ['required', 'string', 'unique:usuarios,cpf', 'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'],
            'pais' => ['required', 'string'],
            'cidade' => ['required', 'string'],
            'estado' => ['required', 'string'],
            'email' => ['required', 'email','unique:usuarios,email'],
            'telefone1' => ['required', 'string', 'unique:telefone_usuarios,telefone', 'regex:/^\(\d{2}\)\d{4}-\d{4}$/'],
            'telefone2' => ['required', 'string', 'unique:telefone_usuarios,telefone', 'regex:/^\(\d{2}\)\d{5}-\d{4}$/'],
            'telefone3' => ['nullable', 'string', 'unique:telefone_usuarios,telefone', 'regex:/^\(\d{2}\)\d{5}-\d{4}$/'],
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
            'email.unique'=>'Email ja registrado ou invalido',
            'cep.regex' => 'O campo CEP deve estar no formato 99999-999.',
            'cpf.regex' => 'O campo CPF deve estar no formato 999.999.999-99.',
            'telefone1.regex' => 'O campo Telefone Fixo deve estar no formato (99)9999-9999.',
            'telefone2.regex' => 'O campo Telefone Móvel deve estar no formato (99)99999-9999.',
            'telefone3.regex' => 'O campo Telefone Reserva deve estar no formato (99)99999-9999.'
        ]);
    }

    private function validaçãoUpdateUsuario($request, $usuario)
    {
        $request->validate([
            'atribuicao' => ['required'],
            'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
            'name' => ['required', 'string'],
            'password' => ['nullable'],
            'lastName' => ['required', 'string'],
            'genero' => ['required', 'in:MASCULINO,FEMININO'],
            'cep' => ['required', 'string', 'regex:/^\d{5}-\d{3}$/'],
            'cpf' => ['required', 'string', Rule::unique('usuarios', 'cpf')->ignore($usuario->idUsuario, 'idUsuario')],
            'pais' => ['required', 'string'],
            'cidade' => ['required', 'string'],
            'estado' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('usuarios', 'email')->ignore($usuario->idUsuario, 'idUsuario')],
            'telefone1' => ['required', 'string', Rule::unique('telefone_usuarios','telefone')->ignore($usuario->idUsuario, 'Usuarios_idUsuario')],
            'telefone2' => ['required', 'string', Rule::unique('telefone_usuarios','telefone')->ignore($usuario->idUsuario, 'Usuarios_idUsuario')],
            'telefone3' => ['nullable', 'string', Rule::unique('telefone_usuarios','telefone')->ignore($usuario->idUsuario, 'Usuarios_idUsuario')],
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
            'email.unique'=>'Email ja registrado ou invalido',
            'cep.regex' => 'O campo CEP deve estar no formato 99999-999.',
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
