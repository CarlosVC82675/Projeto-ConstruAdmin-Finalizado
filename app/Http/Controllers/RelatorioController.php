<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Obras;
use App\Models\Atividades;
use App\Models\Usuario;
use App\Models\card_atividades;
use App\Models\Materiais_Estoque;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\ExceptionHandlerService;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;


class RelatorioController extends Controller
{
    protected $userService;
    protected $exceptionHandler;

    //injeção de dependencia
    public function __construct(UserService $userService,  ExceptionHandlerService $exceptionHandler)
    {
        $this->userService = $userService;
        $this->exceptionHandler = $exceptionHandler;
    }

public function gerarRelatorioObra($idObra)
{
    if (!$this->userService->VerificarPermissao('relatorioObra')) {
        // Caso não tenha permissão (Controle de Acesso)
        return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
    }

    // Obter informações da obra
    $obra = Obras::findOrFail($idObra);

    $mesAtual = Carbon::now()->month;
    $anoAtual = Carbon::now()->year;

    $atividadesFeitasMesAtual = DB::table('atividade')
    ->join('card_atividades', 'atividade.card_atividades_idCard', '=', 'card_atividades.idCard')
    ->where('card_atividades.Obras_IdObras', $idObra)
    ->where('atividade.status', 'FINALIZADO')
    ->whereMonth('atividade.created_at', $mesAtual)
    ->whereYear('atividade.created_at', $anoAtual)
    ->get();


    $cardatividade = card_atividades::all();


     // Mesma coisa mais pega apenas as que ja não estão feitas
    $atividadesDaObra = DB::table('atividade')
    ->join('card_atividades', 'atividade.card_atividades_idCard', '=', 'card_atividades.idCard')
    ->where('card_atividades.Obras_IdObras', $idObra)
    ->get();

    $usuariosAtividades = DB::table('lista_atividade')
    ->join('usuarios', 'lista_atividade.Usuarios_idUsuario', '=', 'usuarios.idUsuario')
    ->select('usuarios.*')
    ->distinct()
    ->get();


    // Informações resumidas dos usuários
    $usuariosObra = Usuario::whereHas('obras', function ($query) use ($idObra) {
        $query->where('Obras_idObras', $idObra);
    })->get();


    // Retorne os dados ou faça algo com eles
    $data = [
        'obra' => $obra,
        'atividadesFeitasMesAtual' => $atividadesFeitasMesAtual,
        'atividadesDaObra' => $atividadesDaObra,
        'usuariosObra' => $usuariosObra,
        'cardatividade' => $cardatividade,
    ];

    // Renderizar a view com os dados
    $pdf = PDF::loadView('reports.relatorio', $data);

    // Gerar o PDF e fazer o download
    return $pdf->download('relatorio_obra.pdf');
}


public function gerarRelatorioMaterias($idObra)
{
    if (!$this->userService->VerificarPermissao('relatorioMaterial')) {
        // Caso não tenha permissão (Controle de Acesso)
        return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
    }

    $obra = Obras::findOrFail($idObra);

    $materiasEstoque = Materiais_Estoque::all();

    $materiaisDaObra = $obra->materiais()->get();
             // dd($materiaisNecessarios);

            // Soma a quantidade de todos os materias relacionados a obra especifica
    $totalQuantidade = $materiaisDaObra->sum('pivot.quantidade');


    // Retorne os dados ou faça algo com eles
    $data = [
        'obra' => $obra,
        'materiasEstoque' => $materiasEstoque,
        'materiaisDaObra' => $materiaisDaObra,
        'totalQuantidade' => $totalQuantidade,
    ];

    // Renderizar a view com os dados
    $pdf = PDF::loadView('reports.relatorioMateriais', $data);

    // Gerar o PDF e fazer o download
    return $pdf->download('relatorio_Materiais.pdf');
}

public function gerarRelatorioGeral()
{
    if (!$this->userService->VerificarPermissao('relatorioGeral')) {
        // Caso não tenha permissão (Controle de Acesso)
        return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
    }

    // Obter informações da obra
    $obras = Obras::all();
    $usuarioscadastrados = Usuario::all();
    $materiasEstoque = Materiais_Estoque::all();

      // Informações resumidas dos usuários


    // Retorne os dados ou faça algo com eles
    try {
    $data = [
        'obras' => $obras,
        'usuarioscadastrados' => $usuarioscadastrados,
        'materiasEstoque' => $materiasEstoque,
    ];

    // Renderizar a view com os dados
    $pdf = PDF::loadView('reports.relatorioGeral', $data);

    $tempPath = storage_path('app/public/temp/relatorio_Geral.pdf');
    $pdf->save($tempPath);
    // Gerar o PDF e fazer o download
    return view('reports.relatorioGeral', compact('tempPath','obras','usuarioscadastrados','materiasEstoque'));

    return redirect()->back()->with('success','Relatorio Cadastrado com Sucesso!');
    } catch (\Exception $e) {
    // Registrar detalhes do erro
    Log::error('Erro ao gerar o relatório: ' . $e->getMessage());

    // Lançar uma exceção ou lidar com o erro de outra forma
    return redirect()->back()->with('error', $e->getMessage());
    }
}


}
