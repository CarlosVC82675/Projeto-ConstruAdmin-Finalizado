<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\AtribuicaoUsuario;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuariosController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::all();

        return view("ListaUsuarios",compact('usuarios'));
    }


    public function create()
    {
        $atribuicoes = AtribuicaoUsuario::all();
        $supervisores = Usuario::whereNull('Superior_idUsuario')->get();

        return view("CadastroUsuario",compact('supervisores','atribuicoes'));
    }


    public function store(Request $request)
    {
        //Inicio do Codigo
        //-------------------------------------------------------------------------
        //Validação
        $this->validaçãoUsuario($request);
        //-----------------------------------------------------------------------------

        try {
        // Início da transação
        DB::beginTransaction();

        //colocando dados de Usuarios
        $usuarioData = $request->except('telefone1', 'telefone2', 'telefone3');
        $usuarioData['password'] = bcrypt($usuarioData['cpf']);

        // Filtra dados vazios:
        // array_filter remove todos os elementos do array que são considerados vazios (nulos, '', 0, false, array(), etc.).
        $usuarioData = array_filter($usuarioData);

        //Criação de Usuarios
        $usuario = Usuario::create($usuarioData);

        $this->storeTelefones($usuario, $request, false);

        // Confirma a transação se tudo estiver correto
        DB::commit();

        }catch (\PDOException $erro) {
            $this->pdoException($erro);
        }catch (QueryException $exception) {
            $this->queryException($exception);
        }

        return redirect()->back()->with('success','Usuario Cadastrado com Sucesso!');
        //Fim do codigo
    }


    public function show($idUsuario)
    {
        try {
            $usuario = Usuario::findOrFail($idUsuario);
            } catch (ModelNotFoundException $exception) {
                return redirect()->back()->with('error',
                'O Usuário parace invalido, tente novamente ou consulte o suporte.');
            }

        return view("VerUsuario",compact('usuario'));
    }


    public function edit($idUsuario)
    {
        try {
            $usuario = Usuario::findOrFail($idUsuario);
            } catch (ModelNotFoundException $exception) {
                return redirect()->back()->with('error',
                'O Usuário parace invalido, tente novamente ou consulte o suporte.');
            }

        return view("EditarUsuarios",compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $this->validaçãoUsuario($request);

        // Encontra o usuário pelo ID
        $usuarioAtualizado =  $request->except('telefone1', 'telefone2', 'telefone3');

        try {
            $usuario = Usuario::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            $this->modelNotFound($exception);
        }

        try{
        // Início da transação
        DB::beginTransaction();

        // Filtra dados vazios:
        // array_filter remove todos os elementos do array que são considerados vazios (nulos, '', 0, false, array(), etc.).
        $usuarioAtualizado = array_filter($usuarioAtualizado);

        // Atualiza os dados do usuário
        $usuario->update($usuarioAtualizado);

        $this->storeTelefones($usuario, $request, true);

        // Confirma a transação se tudo estiver correto
        DB::commit();

        }catch (\PDOException $erro) {
            $this->pdoException($erro);
        }catch (QueryException $exception) {
            $this->queryException($exception);
        }

        return redirect()->back()->with('success','Usuario Atualizado com Sucesso!');

    }

    public function destroy(int $idUsuario, int $condicional = 0)
    {
        // Encontra o usuário pelo ID
        try {
            $usuario = Usuario::findOrFail($idUsuario);
            $idObra = $usuario->obras->idObras;
            } catch (ModelNotFoundException $exception) {
                $this->modelNotFound($exception);
            }

        //dessassociarUsuario
        if($condicional == 1){

            if(!$idObra){
                return redirect()->back()->with('error', 'Ocorreu um erro nao esperado, por favor consulte o suporte');
            }
            $AssociacaoController = new ListaObrasController();
            $AssociacaoController->desassociarUsuario($idObra,$idUsuario);
        }

        if ($usuario->obras()->count() > 0) {
            // O usuário tem associações
        } else {
        // Remove o usuário
        $usuario->delete();
        }

        return redirect()->back()->with('success','Usuario deletado com Sucesso!');
    }

    private function validaçãoUsuario($request)
    {
        $usuarios = $request->validate([
            'atribuicao_Usuario_id_Atribuicao' => ['required', 'exists:atribuicao_usuario,id_atribuicao'],
            'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
            'Superior_idUsuario' => ['nullable', 'exists:usuarios,idUsuario'],
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

    private function pdoException(\PDOException $erro)
    {
        $errorCode = $erro->getCode();
        if ($errorCode === '2002' || $errorCode === '1045' || $errorCode === '1049') {

        // Desfaz a transação em caso de erro
        DB::rollBack();
        return redirect()->back()->with('error', 'Ocorreu um erro ao tentar se conectar ao banco, por favor consulte o suporte');

        }
    }

    private function queryException($exception)
    {

        $errorCode = $exception->getCode();
        if ($errorCode === '23000') {

            DB::rollBack();
            return redirect()->back()->with('error', 'Este registro já existe na base de dados.');

        } else {
            // Outro tipo de erro de QueryException
            return redirect()->back()->with('error', 'Ocorreu um erro na base de dados.');
        }
    }

    private function modelNotFound($exception)
    {
        return redirect()->back()->with('error',
        'O Usuário ou a obra paracem invalidos, guarde o codigo do erro e consulte o suporte .');
    }

    private function storeTelefones($usuario, $request, $update){
         //Telefones
         $telefones = [];

         //Agrupar os telefones em um Array
         for ($i = 1; $request->has('telefone' . $i); $i++) {
             $telefones[] = $request->input('telefone' . $i);
         }

         // Filtra telefones vazios:
         // array_filter remove todos os elementos do array que são considerados vazios (nulos, '', 0, false, array(), etc.).
         $telefones = array_filter($telefones);

         if($update){
         // Adiciona ou atualiza os telefones sem remover os existentes
         $usuario->telefones()->syncWithoutDetaching($telefones);
         }else{
          // Criando registros de telefone associados ao usuário
         foreach ($telefones as $telefone) {
         $usuario->telefones()->create(['telefone' => $telefone]);
          }
        }

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
