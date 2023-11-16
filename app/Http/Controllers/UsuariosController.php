<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;


class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validação
        $usuarios = $request->validate([
        'atribuicao_Usuario_id_Atribuicao' => ['required','exists:atribuicao_usuario,id_atribuicao'],
        'Estoque_idEstoque' => ['required','exists:estoque,idEstoque'],
        'Superior_idUsuario' => ['exists:usuarios,idUsuario'],
        'name' =>['required',',string'],
        'lastName'=>['required',',string'],
        'genero'=>['required', 'in:Masculino,Feminino'],
        'cep'=>['required','string','regex:/^\d{5}-\d{3}$/'],
        'cpf' => ['required','string','unique:usuarios,cpf','regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'],
        'pais' => ['required','string'],
        'cidade' => ['required','string'],
        'estado' => ['required','string'],
        'email'  => ['required','email']
        ]);


        //Tratamento de exceções
        try {
            $senhaAleatoria = Str::random(12);
            $usuarios['password'] = bcrypt($senhaAleatoria);
            $usuarios = Usuario::create($usuarios);
        //Capturando exceções do banco de dados
        } catch (QueryException $erros) {
        //verificando se a informação do erro e igual a 1062
            if ($erros->errorInfo[1] === 1062) {
                 return redirect()->back()->with('error', 'Alguma informação já foi inserida anteriormente');
            }

        //. Quando ocorre um erro de conexão com o banco de dados, o Laravel lança uma exceção PDOException
        //. Essa exceção encapsula detalhes específicos do erro, incluindo o código de erro.
        } catch (\PDOException $erro) {
            $errorCode = $erro->getCode();
            if ($errorCode === '2002' || $errorCode === '1045' || $errorCode === '1049') {
                return redirect()->back()->with('error', 'Ocorreu um erro ao tentar se conectar ao banco, por favor consulte o suporte');
            }
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
