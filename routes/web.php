<?php


use App\Http\Controllers\ListaObrasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiteDashboardController;
use App\Http\Controllers\SiteObraController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AtividadesController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\CardAtividadesController;
use App\Http\Controllers\RelatorioController;
use App\Http\Middleware\NA0Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaisNecessariosController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Rota de teste para ver o layout
Route::middleware('checklogin')->group(function () {

    Route::get('/usuario/view/redefinirsenha',[LoginController::class, 'viewRedefinirSenha'])->name("redefinir.senha");
    Route::post('/usuario/redefinirsenha',[UsuariosController::class, 'redefinirSenha'])->name("usuarios.redefinirSenha");

//usuarios feito por Carlos
    Route::get('/usuario/view/lista',[SiteDashboardController::class, 'ViewUsuarios'])->name("usuarios.lista")->middleware('na0');
    Route::post('/usuario/cadastrar',[UsuariosController::class, 'store'])->name("usuarios.cadastrar");
    Route::put('/usuario/atualizar/{id}',[UsuariosController::class, 'update'])->name("usuarios.atualizar");
    Route::delete('/usuario/deletar/{id}',[UsuariosController::class, 'destroy'])->name("usuarios.deletar");
//fim de usuarios

//obras feito por Diego
    //views da obra
        Route::get('/', [SiteDashboardController::class, 'dashboard'])->name('site.index');
        Route::get('/obra/criar', [SiteDashboardController::class, 'criarobra'])->name('site.criarobra')->middleware('na0');
        Route::get('/obra/{id}/editar', [SiteDashboardController::class, 'edit'])->name('obra.editar')->middleware('na0');
    //fim das views

    //Dashboard dentro por carlos
        Route::get('/obra/{id}', [SiteObraController::class, 'dashboardDentro'])->name('obra.dashboard');
    //Fim do Dashboard

    //Funcionalidades
        Route::get('/obra/{id}/desativar', [ObraController::class, 'desativar'])->name('obra.desativar')->middleware('na0');
        Route::post('/obra', [ObraController::class, 'store'])->name('obra.store');
        Route::put('/obra/{id}/editar', [ObraController::class, 'update'])->name('obra.update');
        Route::post('/obra/cliente', [UsuariosController::class, 'store'])->name('cliente.cadastrar');
        Route::post('/obra/associar', [ListaObrasController::class, 'associarVariosUsuarios'])->name('funcionario.associar');
    //Fim das funcionalidades

    Route::post('/obra/associardashboard', [ListaObrasController::class, 'associarVariosUsuariosDashboard'])->name('usuarios.associar');
    Route::post('/obra/desassociar', [ListaObrasController::class, 'desassociarVariosUsuariosDashboard'])->name('usuarios.desassociar');


//fim de obras

//inicio rota estoque feito por Ana
    Route::get('/material/ver', [SiteDashboardController::class, 'verMateriais'])->name("ver.material")->middleware('na1');
    Route::post('/material/ver/cadastrar', [MaterialController::class, 'storeMaterial'])->name("registrar.material");
    Route::post('/material/adicionar/{id}', [MaterialController::class, 'adicionarEstoque'])->name("adicionar.material");
    Route::post('/material/remover/{id}', [MaterialController::class, 'removerEstoque'])->name("remover.material");
    Route::put('/material/update/{id}', [MaterialController::class, 'updateMaterial'])->name("atualizar.material");
    Route::delete('/material/deletar/{id}', [MaterialController::class, 'destroyMaterial'])->name("deletar.material");
//fim rota estoque


//rota de arquivos feito por diego
Route::get('/obra/{id}/foto', [SiteObraController::class, 'foto'])->name('obra.foto');
Route::get('/obra/{id}/arquivo', [SiteObraController::class, 'arquivo'])->name('obra.arquivo');
Route::get('/projeto/download/{ida}', [ArquivoController::class, 'download'])->name('arquivo.download');
Route::get('/projeto/visualizar/{ida}', [ArquivoController::class, 'visualizar'])->name('arquivo.visualizar');
Route::post('/obra/{id}/foto', [ArquivoController::class, 'store'])->name('foto.store');
Route::get('/projeto/pesquisar', [ArquivoController::class, 'pesquisarFoto'])->name('foto.pesquisar');
Route::delete('/obra/{id}/foto/{ida}', [ArquivoController::class, 'destroy'])->name('foto.destroy');

//fim de rota arquivos

// ROTAS FEITAS POR THAUAN //

//KANBAN DE ATIVIDADES DIRETO
ROUTE::GET('Atividade/Kanban_atividades/{id}',[SiteObraController::class,'Kanban_atividades_view'])->name('Atividade.Kanban');
//KANBAN ATIVIDADE CHECKED ( PASSE PRIMEIRO PARA ESSE O DIRETO E O DIRETO PASSA PARA ESSE AQUI)
ROUTE::GET('Atividade/Listar_Atividade/{id}',[AtividadesController::class,'Listar_ATV_Obra'])->name('Atividade.Listar');
//CRIAR ATIVIDADE
ROUTE::POST('Atividade/Criar_Atividade',[AtividadesController::class,'adicionarAtividade'])->name('Atividade.Criar');
//ATUALIZAR ATIVIDADE
ROUTE::PUT('Atividade/Atualizar_Atividade/{idAtividade}',[AtividadesController::class,'atualizarAtividade'])->name('Atividade.Atualizar');
//DELETAR ATIVIDADE
ROUTE::DELETE('/Atividade/Deletar_Atividade/{idAtividade}/{idobra}',[AtividadesController::class,'delete_atv'])->name('Atividade.Deletar');
//ASSOCIAR USUARIO A ATIVIDADE
ROUTE::PUT('Atividade/Associar_Usuario/{idAtividade}/{idUsuario}/{idobra}',[AtividadesController::class,'associarUsuarioAtividade'])->name('Atividade.Associar');
//CARDS
//CRIAR CARD
ROUTE::POST('Card/Atividade/Criar_Card',[CardAtividadesController::class,'criar_card'])->name('Card.Criar');
//DELETAR CARD
ROUTE::DELETE('Card/Atividade/Deletar/{idCard}/{idobra}',[CardAtividadesController::class,'deleteCard'])->name('Card.Deletar');
//COMENTARIOS
//CRIAR COMENTARIO
ROUTE::POST('Atividade/Comentarios/Criar_Comentarios/{Atividadeid}/{UsuariosID}',[ComentariosController::class,'criarComentarios'])->name('Comentario.Criar');
//DELETAR COMENTARIO
ROUTE::DELETE('Atividade/Comentarios/Deletar_Comentario/{idComentario}',[ComentariosController::class,'DeletarComentario'])->name('Deletar.Comentario');

// ---- VIEWS DO SIDEBAR --//

//RELATORIO DE ATIVIDADES
//ROTA PARA A VIEW
ROUTE::GET('Atividade/Relatorio/{idObra}',[AtividadesController::class,'Relatorio_ATV'])->name('Relatorio.Atividade');
//LISTA DE FUNCIONARIOS RASOS
//ROTA PARA A VIEW
ROUTE::GET('Atividade/Lista_Funcionario/{idObra}',[AtividadesController::class,'Lista_Funcionario'])->name('Lista_Funcionario.Atividade');
//LISTA DE RESPONSAVEIS
//ROTA PARA A VIEW
ROUTE::GET('Atividade/Lista_Responsaveis/{idObra}',[AtividadesController::class,'Lista_Responsaveis'])->name('Lista_Responsaveis.Atividade');


//Relatorios por Carlos
Route::get('/obra/relatorio/{id}', [SiteObraController::class, 'relatoriosView'])->name('obra.relatorios');
Route::get('/relatorio/{id}', [RelatorioController::class, 'gerarRelatorioObra'])->name('relatorio.obra');
Route::get('/relatorioMaterial/{id}', [RelatorioController::class, 'gerarRelatorioMaterias'])->name('relatorio.materiais');
Route::get('/relatorioGeral', [RelatorioController::class, 'gerarRelatorioGeral'])->name('relatorio.geral');

//Inicio materiais necessarios por Ana
Route::get('/obra/materiais/{id}', [SiteObraController::class, 'verMaterialObra'])->name('obra.materiais');
Route::post('/obra/materiais/associar/{id}', [MateriaisNecessariosController::class, 'associarMateriais'])->name("associar.material");
Route::post('/obra/materiais/remover/{idMaterial}', [MateriaisNecessariosController::class, 'retirarQuantidadeMateriaisObra'])->name("remover.mNecessario");
Route::post('/obra/materiais/desassociar/{idMateriais}', [MateriaisNecessariosController::class, 'desassociarMaterialObra'])->name('desassociar.material.obra');

//FIM materiais necessarios

});

//login feito por Carlos
Route::get('/login',[SiteDashboardController::class, 'index'])->name('login.form');
Route::post('/auth',[LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout',[LoginController::class, 'logout'])->name('login.logout');
//fim do login




