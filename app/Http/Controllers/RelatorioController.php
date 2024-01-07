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
use Illuminate\Support\Facades\Storage;


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

    $tempDir = 'public/temp/';

     // Criar o diretório temporário se não existir
     Storage::makeDirectory($tempDir);

     // Caminho completo para o arquivo temporário
     $tempPath = storage_path('app/' . $tempDir . 'relatorio_obra.pdf');

      // Salvar o PDF
      Storage::put($tempDir . 'relatorio_obra.pdf', $pdf->output());

      return view('reports.visualizarRelatorio', compact('obra', 'atividadesFeitasMesAtual', 'atividadesDaObra','usuariosObra','cardatividade'));
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
    $totalQuantidade = $materiaisDaObra->sum('pivot.quantidade');

    $data = [
        'obra' => $obra,
        'materiasEstoque' => $materiasEstoque,
        'materiaisDaObra' => $materiaisDaObra,
        'totalQuantidade' => $totalQuantidade,
    ];

    $pdf = PDF::loadView('reports.relatorioMateriais', $data);

    $tempDir = 'public/temp/';

     // Criar o diretório temporário se não existir
     Storage::makeDirectory($tempDir);

     // Caminho completo para o arquivo temporário
     $tempPath = storage_path('app/' . $tempDir . 'relatorio_Materiais.pdf');

      // Salvar o PDF
      Storage::put($tempDir . 'relatorio_Materiais.pdf', $pdf->output());

      return view('reports.visualizarRelatorioMateriais', compact('obra', 'materiasEstoque', 'materiaisDaObra','totalQuantidade'));
}







public function gerarRelatorioGeral()
{
    if (!$this->userService->VerificarPermissao('relatorioGeral')) {
        // Caso não tenha permissão (Controle de Acesso)
        return redirect()->back()->with('error', 'Você não tem Permissão para Fazer isso!');
    }

    try {
        // Obter informações da obra
        $obras = Obras::all();
        $usuarioscadastrados = Usuario::all();
        $materiasEstoque = Materiais_Estoque::all();

        // Renderizar a view com os dados
        $pdf = PDF::loadView('reports.relatorioGeral', compact('obras', 'usuarioscadastrados', 'materiasEstoque'));

        // Caminho para o diretório temporário
        $tempDir = 'public/temp/';

        // Criar o diretório temporário se não existir
        Storage::makeDirectory($tempDir);

        // Caminho completo para o arquivo temporário
        $tempPath = storage_path('app/' . $tempDir . 'relatorio_Geral.pdf');

        // Salvar o PDF
        Storage::put($tempDir . 'relatorio_Geral.pdf', $pdf->output());

        // Retornar a view com o link para download

        return view('reports.visualizarRelatorioGeral', compact('obras', 'usuarioscadastrados', 'materiasEstoque'));
    } catch (\Exception $e) {
        // Registrar detalhes do erro
        Log::error('Erro ao gerar o relatório: ' . $e->getMessage());

        // Lançar uma exceção ou lidar com o erro de outra forma
        return redirect()->back()->with('error', $e->getMessage());
    }
}


}
