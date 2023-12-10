<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais_Estoque;
use Carbon\CarbonImmutable;
use Illuminate\Validation\Rules\Exists;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function verMaterial(){
        return view('site.siteMenu.estoque.material');
    }

    public function verMaterialAdicionado($idMaterial){
       try{ $material = Materiais_Estoque::findOrFail($idMaterial);
        return view('site.siteMenu.estoque.materialAdicionar', compact('material'));
       } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Identificação inválida');
       }
    }

    public function verMaterialRemovido($idMaterial){
        try{
        $material = Materiais_Estoque::findOrFail($idMaterial);
        return view('site.siteMenu.estoque.materialRemover', compact('material'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
    }
    public function verMaterialAtualizado($idMaterial){
        try{
        $material = Materiais_Estoque::findOrFail($idMaterial);
        return view('site.siteMenu.estoque.materialAtualizar', compact('material'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
    }

    public function verMaterialDeletado($idMaterial){
        try{
        $material = Materiais_Estoque::findOrFail($idMaterial);
        return view('site.siteMenu.estoque.materialDeletar', compact('material'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeMaterial(Request $request){

        // dd($request);
         $request->validate([
            'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
            'kg' => ['required', 'numeric'],
            'nomeM' => ['required', 'string', 'max:50'],
            'metros' => ['nullable', 'numeric'],
            'quantidade' => ['required', 'numeric', 'integer'],
            'dtVencimento' => ['nullable', 'date'],
            'dtEntrada' => ['required', 'date'],
            'Status_2' => ['required', 'in:usado,novo']
         ], [
            'kg.required' => 'o peso é necessario',
            'kg.numeric' => 'Insira um número válido',
            'nomeM.required' => 'insira o nome',
            'nomeM.max:50' => 'Insira um nome com um máximo de 50 caracteres',
            'metros.numeric' => 'Insira um número válido',
            'quantidade.required' => 'Insira as quantidades',
            'quantidade.numeric' => 'Insira um número válido',
            'quantidade.integer' => 'insira um número inteiro',
            'dtVencimento.date' => 'Insira uma data válida',
            'Status_2.required' => 'insira os status',
            'Status_2.in' => 'insira usado ou novo',
         ]);

        try{
            Materiais_Estoque::create(
                $request->all()
            );
        } catch (\PDOException $erro){
            return redirect()->back()->with('erro', 'Ocorreu um erro ao inserir o usuário no banco de dados');
        } catch (QueryException $exception){
            return redirect()->back()->with('erro', 'Ocorreu um erro no sistema, tente novamente');
        }

        return redirect()->back()->with('sucesso', 'Material adicionado ao estoque com sucesso.');
    }



     //o usuário pode alterar apenas a quantidade de materiais e a data de entrada
     public function adicionarEstoque(Request $request, $idMaterial){
        try{
            $material = Materiais_Estoque::findOrFail($idMaterial);
            $request->validate([
                'quantidade' => ['required', 'numeric', 'integer'],
            ], [
                'quantidade.required' => 'Insira as quantidades',
                'quantidade.numeric' => 'Insira um número válido',
                'quantidade.integer' => 'insira um número inteiro'
            ]);

            $quantidade = $request->input('quantidade');
            $valorAdicionado = $quantidade + $material->quantidade;

            $dtEntrada = $request->input('dtEntrada');

            $material->quantidade = $valorAdicionado;
            $material->dtEntrada = $dtEntrada;
            $material->save();

            return redirect()->back()->with('sucesso', 'Material atualizado com sucesso');
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
     }

     //o usuário pode remover apenas a quantidade de materiais e alterar a data de saida
     public function removerEstoque(Request $request, $idMaterial){
        try{
            $material = Materiais_Estoque::findOrFail($idMaterial);
            $request->validate([
                'quantidade' => ['required', 'numeric', 'integer'],
            ], [
                'quantidade.required' => 'Insira as quantidades',
                'quantidade.numeric' => 'Insira um número válido',
                'quantidade.integer' => 'insira um número inteiro'
            ]);

            $quantidade = $request->input('quantidade');

            if($quantidade>$material->quantidade){
                return redirect()->back()->with('erro', 'Você não pode tirar mais materiais do que tem no estoque');
            }
            $valorRemovido = $material->quantidade - $quantidade;

            $dtSaida = $request->input('dtSaida');

            $material->quantidade = max(0, $valorRemovido);
            $material->dtSaida = $dtSaida;
            $material->save();

            return redirect()->back()->with('sucesso', 'Material atualizado com sucesso');
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
     }


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
    public function updateMaterial(Request $request, $idMaterial) {
        try{
        $material = Materiais_Estoque::findOrFail($idMaterial);
            $request->validate([
                'Estoque_idEstoque' => ['required', 'exists:estoque,idEstoque'],
                'kg' => ['required', 'numeric'],
                'nomeM' => ['required', 'string', 'max:50'],
                'metros' => ['nullable', 'numeric'],
                'quantidade' => ['required', 'numeric', 'integer'],
                'dtVencimento' => ['nullable', 'date'],
                'dtEntrada' => ['required', 'date'],
                'Status_2' => ['required', 'in:usado,novo']
                ], [
                'kg.required' => 'o peso é necessario',
                'kg.numeric' => 'Insira um número válido',
                'nomeM.required' => 'insira o nome',
                'nomeM.max:50' => 'Insira um nome com um máximo de 50 caracteres',
                'metros.numeric' => 'Insira um número válido',
                'quantidade.required' => 'Insira as quantidades',
                'quantidade.numeric' => 'Insira um número válido',
                'quantidade.integer' => 'insira um número inteiro',                    'dtVencimento.date' => 'Insira uma data válida',
                'Status_2.required' => 'insira os satus',
                'Status_2.in' => 'insira usado ou novo',
                ]);

            $material->update($request->all());
            return redirect()->back()->with('sucesso', 'material atualizado');
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
    }

    public function destroyMaterial($idMaterial){
        try{
        $material = Materiais_Estoque::findOrFail($idMaterial);
        $material->delete();

        return redirect()->route('registrar.material')->with('sucesso', 'material deletado');
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Identificação inválida');
        }
    }
}
