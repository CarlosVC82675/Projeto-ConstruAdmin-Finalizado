<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais_Estoque;
use Carbon\CarbonImmutable;
use Illuminate\Validation\Rules\Exists;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\UserService;

class MaterialController extends Controller{
    //feito por ana

    protected $userService;

    //injeção de dependencia
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    //essa função cadastra os materiais no estoque recebendo as informacoes dos usuários
    public function storeMaterial(Request $request){
    if($this->userService->VerificarPermissao('Estoque')){

        //validação
         $request->validate([
            'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
            'kg' => ['required', 'numeric', 'min:0'],
            'nomeM' => ['required', 'string', 'max:50'],
            'metros' => ['nullable', 'numeric', 'min:0'],
            'quantidade' => ['required', 'numeric', 'integer', 'min:0'],
            'dtVencimento' => ['nullable', 'date'],
            'dtEntrada' => ['required', 'date'],
            'Status_2' => ['required', 'in:usado,novo']
         ], [
            //mensagem estilizada caso falte algo na validacao
            'kg.required' => 'o peso é necessario',
            'kg.numeric' => 'Insira um número válido',
            'kg.min' => 'O valor deve ser positivo',
            'nomeM.required' => 'insira o nome',
            'nomeM.max' => 'Insira um nome com um máximo de 50 caracteres',
            'metros.numeric' => 'Insira um número válido',
            'metros.min' => 'O valor deve ser positivo',
            'quantidade.required' => 'Insira as quantidades',
            'quantidade.numeric' => 'Insira um número válido',
            'quantidade.integer' => 'insira um número inteiro',
            'quantidade.min' => 'insira um número maior que 0',
            'dtVencimento.date' => 'Insira uma data válida',
            'Status_2.required' => 'insira os status',
            'Status_2.in' => 'insira usado ou novo',
         ]);

        try{
            //ele tenta cadastrar o material
            Materiais_Estoque::create(
                $request->all()
            );
        } catch (\PDOException $erro){
            //aqui ele usa o pdoexception para ver se deu algum problema ao registrar o material no banco e acontece o mesmo nas outras partes do codigo
            return redirect()->back()->with('erro', 'Ocorreu um erro ao inserir o material no estoque');
            //o query pra ver se ocorreu algum erro no sistema
        } catch (QueryException $exception){
            return redirect()->back()->with('erro', 'Ocorreu um erro no sistema, tente novamente');
        }

        return redirect()->back()->with('sucesso', 'Material adicionado ao estoque com sucesso.');
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }
    }



     //Nessa funcao o usuário pode alterar apenas a quantidade de materiais e a data de entrada
     public function adicionarEstoque(Request $request, $idMaterial){
    if($this->userService->VerificarPermissao('Estoque')){
        try{
            $material = Materiais_Estoque::findOrFail($idMaterial);
            //validacao das informacoes inseridas pelo usuario
            $request->validate([
                'quantidade' => ['required', 'numeric', 'integer', 'min:0'],
            ], [
                'quantidade.required' => 'Insira as quantidades',
                'quantidade.numeric' => 'Insira um número válido',
                'quantidade.min' => 'insira um número maior que 0',
                'quantidade.integer' => 'insira um número inteiro'
            ]);

            //armazenamento e calculo do número informado pelo usuário
            $quantidade = $request->input('quantidade');
            $valorAdicionado = $quantidade + $material->quantidade;

            //data de entrada pega na funcao now na view, armazenada na dtEntrada
            $dtEntrada = $request->input('dtEntrada');

            //atributos passados para o banco
            $material->quantidade = $valorAdicionado;
            $material->dtEntrada = $dtEntrada;
            try{
                //salvo no banco
                $material->save();
            } catch (\PDOException $erro){
                return redirect()->back()->with('erro', 'Ocorreu um erro ao atualizar material no estoque');
            } catch (QueryException $exception){
                return redirect()->back()->with('erro', 'Ocorreu um erro no sistema, tente novamente');
            }
            return redirect()->back()->with('sucesso', 'Material atualizado com sucesso');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }
    }

     //Nessa funcao, o usuário pode remover apenas a quantidade de materiais e alterar a data de saida

    public function removerEstoque(Request $request, $idMaterial){
    if($this->userService->VerificarPermissao('Estoque')){
        try{
            $material = Materiais_Estoque::findOrFail($idMaterial);
            //validacao
            $request->validate([
                'quantidade' => ['required', 'numeric', 'integer', 'min:0'],
            ], [
                'quantidade.required' => 'Insira as quantidades',
                'quantidade.numeric' => 'Insira um número válido',
                'quantidade.min' => 'insira um número maior que 0',
                'quantidade.integer' => 'insira um número inteiro'
            ]);

            //pega quantidade digitada pelo usuario na view
            $quantidade = $request->input('quantidade');

            //checa pra ver se a quantidade que o usuario quer diminuir é maior do que o
            //estooque disponivel
            //fiz essa funcao pra evitar materiais com estoque negativo
            if($quantidade>$material->quantidade){
                return redirect()->back()->with('erro', 'Você não pode tirar mais materiais do que tem no estoque');
            }

            //diminui a quantidade
            $valorRemovido = $material->quantidade - $quantidade;

            //armazena a datade saida com o now() e salva no dtSaida
            $dtSaida = $request->input('dtSaida');

            //passa pro banco a quantidade armazenada nos atributos anteriores
            $material->quantidade = max(0, $valorRemovido);
            $material->dtSaida = $dtSaida;
            try{
                $material->save();
            } catch (\PDOException $erro){
                return redirect()->back()->with('erro', 'Ocorreu um erro ao atualizar material no estoque');
            } catch (QueryException $exception){
                return redirect()->back()->with('erro', 'Ocorreu um erro no sistema, tente novamente');
            }

            return redirect()->back()->with('sucesso', 'Material atualizado com sucesso');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }
    }

    public function updateMaterial(Request $request, $idMaterial) {
    if($this->userService->VerificarPermissao('Estoque')){
        try{
        $material = Materiais_Estoque::findOrFail($idMaterial);
        //validacao
            $request->validate([
                'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
                'kg' => ['required', 'numeric'],
                'nomeM' => ['required', 'string', 'max:50'],
                'metros' => ['nullable', 'numeric'],
                'quantidade' => ['required', 'numeric', 'integer', 'min:0'],
                'dtVencimento' => ['nullable', 'date'],
                'dtEntrada' => ['required', 'date'],
                'Status_2' => ['required', 'in:usado,novo']
                ], [
                'kg.required' => 'o peso é necessario',
                'kg.numeric' => 'Insira um número válido',
                'kg.min' => 'O valor deve ser positivo',
                'nomeM.required' => 'insira o nome',
                'nomeM.max' => 'Insira um nome com um máximo de 50 caracteres',
                'metros.numeric' => 'Insira um número válido',
                'quantidade.required' => 'Insira as quantidades',
                'quantidade.numeric' => 'Insira um número válido',
                'quantidade.integer' => 'insira um número inteiro',
                'metros.min' => 'O valor deve ser positivo',
                'quantidade.min' => 'insira um número maior que 0',
                'dtVencimento.date' => 'Insira uma data válida',
                'Status_2.required' => 'insira os satus',
                'Status_2.in' => 'insira usado ou novo',
                ]);
            try{
            //atualiza
            $material->update($request->all());
            } catch (\PDOException $erro){
                return redirect()->back()->with('erro', 'Ocorreu um erro ao atualizar material no estoque');
            } catch (QueryException $exception){
                return redirect()->back()->with('erro', 'Ocorreu um erro no sistema, tente novamente');
            }
            return redirect()->back()->with('sucesso', 'material atualizado');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }
    }

    public function destroyMaterial($idMaterial){
    if($this->userService->VerificarPermissao('Estoque')){
        try{
        $material = Materiais_Estoque::findOrFail($idMaterial);
        try{
        //deleta material
            $material->delete();
        } catch (\PDOException $erro){
            return redirect()->back()->with('erro', 'Ocorreu um erro ao deletar material no estoque');
        } catch (QueryException $exception){
        return redirect()->back()->with('erro', 'Ocorreu um erro no sistema, tente novamente');
        }
        return redirect()->back()->with('sucesso', 'material deletado');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }

    }
}
