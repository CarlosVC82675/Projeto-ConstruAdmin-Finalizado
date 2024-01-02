<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais_Estoque;
use App\Models\Obras;
use App\Services\UserService;

class MateriaisNecessariosController extends Controller
{
    //NAO TESTADO EM PRODUÇAO

    public function associarMateriais(Request $request, $idObra)
    {
        $request->validate([
            'materiais' => 'required|array',
            'materiais.*.id' => 'required|exists:materiais,id',
            'materiais.*.quantidade' => 'required|integer|min:1',
        ]);

        $obra = Obras::findOrFail($idObra);

        foreach ($request->materiais as $materialData) {
            $materialId = $materialData['id'];
            $quantidade = $materialData['quantidade'];

            $material = Materiais_Estoque::findOrFail($materialId);

            if ($material->quantidade < $quantidade) {
                // Lógica para lidar com quantidade insuficiente
                // Por exemplo, retornar uma mensagem de erro ou lançar uma exceção
                return back()->with('error', 'Quantidade insuficiente para o material: ' . $material->nome);
            }

            // Associando o material à obra
            $obra->materiais()->attach($materialId, ['quantidade' => $quantidade]);

            // Atualizando a quantidade disponível do material
            $material->decrement('quantidade', $quantidade);
        }

    }


    public function adicionarQuantidadeMateriaisObra(Request $request, $idObra)
{
    $obra = Obras::findOrFail($idObra);
    $materiais = $request->materiais;

    foreach ($materiais as $materialId => $quantidade) {
        $obra->materiais()->syncWithoutDetaching([$materialId => ['quantidade' => $quantidade]]);
    }
     //use funções de ana
    // Atualiza a quantidade nos materiais, decrementando do estoque principal
    Materiais_Estoque::whereIn('id', array_keys($materiais))
        ->decrement('quantidade', collect($materiais)->sum());

}

public function retirarQuantidadeMateriaisObra(Request $request, $idObra)
{
    $obra = Obras::findOrFail($idObra);
    $materiais = $request->materiais;

    foreach ($materiais as $materialId => $quantidade) {
        $obra->materiais()->syncWithoutDetaching([$materialId => ['quantidade' => -$quantidade]]);
    }

    //use funções de ana
}





}

/*

Aqui está uma explicação linha por linha:

Material::whereIn('id', array_keys($materiais)): Isso cria uma consulta no modelo Material para encontrar registros cujos IDs estão contidos no array de chaves do array $materiais.

->decrement('quantidade', collect($materiais)->sum()): Isso usa o método decrement() do Eloquent para diminuir o valor da coluna quantidade na tabela de materiais.
Ele usa o valor total do somatório das quantidades presentes no array $materiais como o valor a ser subtraído das quantidades de cada material.

Em resumo, esse código decrementa a quantidade de materiais no estoque com base nas quantidades associadas a esses materiais dentro do array fornecido. Por exemplo, se o material de ID 1 tiver uma quantidade de 5 e o material de ID 2 tiver uma quantidade de 10,
e o array $materiais contiver ['1' => 2, '2' => 4], então o código subtrairá 2 do material com ID 1 e 4 do material com ID 2 no banco de dados.

Claro! Esse trecho de código está iterando sobre a lista de materiais e suas respectivas quantidades associadas a uma obra. Para cada material dessa lista, está sendo usado o método syncWithoutDetaching para atualizar a quantidade desse material associado à obra.

$materiais as $materialId => $quantidade: Itera sobre cada material e sua quantidade.
$obra->materiais()->syncWithoutDetaching([$materialId => ['quantidade' => -$quantidade]]);: Utiliza o método syncWithoutDetaching para sincronizar (ou atualizar) os materiais associados à obra, especificamente o material com $materialId. O valor da quantidade é negativo (-$quantidade), o que indica a subtração dessa quantidade do estoque associado à obra.
Essencialmente, esse trecho está removendo a quantidade especificada de cada material associado à obra, reduzindo assim o estoque desses materiais vinculados àquela obra.




User
entao syncWithoutDetaching  ele atualizar as associações?
ChatGPT
Sim, exatamente! O método syncWithoutDetaching é usado para atualizar as associações entre modelos associados em uma relação de muitos-para-muitos sem desassociar outros modelos não mencionados. Isso permite atualizar, adicionar ou remover associações específicas sem afetar o restante das associações.

Ao usar syncWithoutDetaching, você pode atualizar as informações (como quantidades) associadas a um modelo sem desfazer as associações existentes. Isso é útil quando você quer apenas alterar alguns aspectos da relação sem recriá-la por completo.


*/
