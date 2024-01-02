<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obras;
use App\Services\ObraService;
use App\Models\Atividades;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;

class SiteObraController extends Controller
{
    protected $obraService;
    protected $userService;

    //injeção de dependencia
    public function __construct(ObraService $obraService,UserService $userService)
    {
        $this->userService = $userService;
        $this->obraService = $obraService;
    }


    public function dashboardDentro($idobra)
    {

        $usuarios = Usuario::all();
        $obra = $this->obraService->buscarObraId($idobra);
        //dd($atividades);

        //Dados de Usuario
        $usuariosDaObra = $obra->usuarios;

        //Fim de dados do usuario

        //DADOS DE ATIVIDADE

            $atividadesDaObra = DB::table('atividade')
            ->join('card_atividades', 'atividade.card_atividades_idCard', '=', 'card_atividades.idCard')
            ->where('card_atividades.Obras_IdObras', $idobra)
            ->get();

            $atividadesFeitas = DB::table('atividade')
            ->join('card_atividades', 'atividade.card_atividades_idCard', '=', 'card_atividades.idCard')
            ->where('card_atividades.Obras_IdObras', $idobra)
            ->where('atividade.status', 'FINALIZADA')
            ->get();

            $atividadesPendentes = DB::table('atividade')
            ->join('card_atividades', 'atividade.card_atividades_idCard', '=', 'card_atividades.idCard')
            ->where('card_atividades.Obras_IdObras', $idobra)
            ->whereNotIn('atividade.status', ['FINALIZADA'])
            ->get();
        //FIM DE DADOS DE ATIVIDADE

        //MATERIAIS
             $materiaisNecessarios = $obra->materiais()->get();
             // dd($materiaisNecessarios);

            $totalQuantidade = $materiaisNecessarios->sum('pivot.quantidade');

                // Calcular a porcentagem para cada material
                $labels = [];
                $data = [];
                foreach ($materiaisNecessarios as $material) {
                    $porcentagem = ($material->pivot->quantidade / $totalQuantidade) * 100;
                    $labels[] = $material->nomeM; // Armazenar nome do material nos rótulos
                    $data[] = $porcentagem; // Armazenar a porcentagem no conjunto de dados
                }

                // Dados para o gráfico
                $dadosGrafico = [
                    'labels' => $labels, // Rótulos para cada material
                    'data' => $data, // Porcentagens correspondentes
                ];

        //FIM DE MATERIAIS

            //dd($dadosGrafico);


        return view("site.siteObra.Dashboard", compact('obra','dadosGrafico','usuariosDaObra','atividadesFeitas','atividadesPendentes','atividadesDaObra','totalQuantidade'));
    }


    public function foto($id)
    {
      $obra = Obras::find($id);
      $arquivos = $obra->arquivo;

      if (!$obra) {
        abort(404); // Ou redirecione para uma página de erro 404
      }

      return view('site.siteObra.arquivos.foto', compact('obra','arquivos'));
    }

    public function arquivo($id)
    {
      $obra = Obras::find($id);
      $arquivos = $obra->arquivo;

      if (!$obra) {
        abort(404); // Ou redirecione para uma página de erro 404
      }

      return view('site.siteObra.arquivos.arquivo', compact('obra','arquivos'));
    }


    public function Kanban_atividades_view($idobra)
    {
        $obra = Obras::find($idobra);
        session()->put('obra', $obra);
        return redirect()->route('Atividade.Listar', ['id' => $idobra]);
    }



}

