<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais_Estoque;
use App\Models\Obras;
use App\Services\UserService;

class MateriaisNecessariosController extends Controller
{
    public function associarMateriais(Request $request, $idObra) {
        $request->validate([
             'id' => ['required', 'exists:materiais_estoque,idMateriais'],
             'quantidade' => ['required', 'integer', 'min:1'],
         ], [
            'id.required' => 'Insira um ID válido',
            'quantidade.required' => 'Insira umua quantidade',
            'quantidade.integer' => 'Insira um número inteiro',
            'quantidade.min' => 'Insira pelo menos uma unidade',
         ]);

        $obra = Obras::findOrFail($idObra);

        $materialId = $request->input('id');
        $quantidade = $request->input('quantidade');

        $material = Materiais_Estoque::findOrFail($materialId);

        if ($material->quantidade < $quantidade) {
            return back()->with('error', 'Quantidade insuficiente para o material: ' . $material->nomeM);
        }else{
            // Associando o material à obra
            $materialNaObra = $obra->materiais()->where('idMateriais', $materialId)->first();
            if ($materialNaObra) {
                // Se já existe, atualiza a quantidade adicionando mais
                $materialNaObra->pivot->quantidade += $quantidade;
                $materialNaObra->pivot->save();
            } else {
                // Se não existe, cria um novo registro
                $obra->materiais()->attach($materialId, ['quantidade' => $quantidade]);
            }
            // Atualizando a quantidade disponível do material  
            $material->decrement('quantidade', $quantidade);

            return back();
        }
    }

    public function retirarQuantidadeMateriaisObra(Request $request, $idMateriais)
    {
        $request->validate([
            'quantidade' => ['required', 'numeric', 'integer', 'min:1'],
        ], [
            'quantidade.required' => 'Insira as quantidades',
            'quantidade.numeric' => 'Insira um número válido',
            'quantidade.min' => 'insira um número maior que 0',
            'quantidade.integer' => 'insira um número inteiro'
        ]);
        $idObra = $request->input('idObra');
        $obra = Obras::findOrFail($idObra);
        $material = Materiais_Estoque::findOrFail($idMateriais);
        $quantidade = $request->input('quantidade');

        $materialNaObra = $obra->materiais()->where('idMateriais', $material->idMateriais)->first();
        if ($materialNaObra->pivot->quantidade < $quantidade) {
            return back()->with('error', 'Quantidade insuficiente para o material: ' . $material->nomeM);
        }else{
            if ($materialNaObra) {
                // Se já existe, atualiza a quantidade
                $materialNaObra->pivot->quantidade -= $quantidade;
                $materialNaObra->pivot->save();
            }
            return back();
        }
    }

    public function desassociarMaterialObra($idMateriais, Request $request)
    {
        $idObra = $request->input('idObra');

        $obra = Obras::findOrFail($idObra);
        $material = Materiais_Estoque::findOrFail($idMateriais);

        // Obtém a quantidade associada antes de desassociar
        $quantidadeAssociadaAntes = $obra->materiais()->where('idMateriais', $material->idMateriais)->first()->pivot->quantidade;

        // Desassocia completamente o material da obra
        $obra->materiais()->detach($material->idMateriais);

        // Verifica se já existe um registro de MaterialUsado para esse material
        $materialUsadoExistente = Materiais_Estoque::where('nomeM', $material->nomeM . ' (usado)')
            ->where('Status_2', 'usado')
            ->first();

        // Se a quantidade associada antes for maior que zero e não existe um registro usado
        if ($quantidadeAssociadaAntes > 0 && !$materialUsadoExistente) {
            // Cria um novo registro com o status "usado" e a quantidade desassociada
            Materiais_Estoque::create([
                'idMateriais' => $material->idMateriais,
                'Estoque_idEstoque' => $material->Estoque_idEstoque,
                'kg' => $material->kg,
                'nomeM' => $material->nomeM . ' (usado)',
                'metros' => $material->metros,
                'dtVencimento' => $material->dtVencimento,
                'dtEntrada' => $material->dtEntrada,
                'Status_2' => 'usado',
                'quantidade' => $quantidadeAssociadaAntes,
            ]);
        } elseif ($materialUsadoExistente) {
            $materialUsadoExistente->quantidade += $quantidadeAssociadaAntes;
            $materialUsadoExistente->save();

            $materialUsadoExistente->refresh();
        }

        return back();
    }

}