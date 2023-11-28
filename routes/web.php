<?php


use App\Http\Controllers\ListaObrasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiteDashboardController;
use App\Http\Controllers\SiteObraController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\MaterialController;
use App\Models\Materiais_Estoque;
use App\Http\Controllers\AtividadesController;
use Illuminate\Support\Facades\Route;

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
Route::view('/layoutFora', 'site.siteMenu.teste2')->name('Area.Trabalho');
Route::view('/layoutdentro', 'site.siteObra.layoutdentro')->name('obraDentro.layout');
Route::get('/Dashboard/{idObra}', [SiteObraController::class, 'dashboard'])->name('obra.dashboard');




//usuarios feito por Carlos
Route::get('/usuario/view/lista',[SiteDashboardController::class, 'ViewUsuarios'])->name("usuarios.lista");
Route::get('/usuario/view/cadastro',[SiteDashboardController::class, 'ViewCadastroUsuario'])->name("usuarios.cadastro");
Route::get('/usuario/view/usuario/{id}',[SiteDashboardController::class, 'ViewUsuario'])->name("usuarios.ver");
Route::get('/usuario/view/editar/{id}',[SiteDashboardController::class, 'ViewEditarUsuario'])->name("usuarios.edicao");
Route::post('/usuario/cadastrar',[UsuariosController::class, 'store'])->name("usuarios.cadastrar");
Route::put('/usuario/atualizar/{id}',[UsuariosController::class, 'update'])->name("usuarios.atualizar");
Route::delete('/usuario/deletar/{id}',[UsuariosController::class, 'destroy'])->name("usuarios.deletar");
//fim de usuarios


//login feito por Carlos
Route::get('/login',[LoginController::class, 'index'])->name('login.form');
Route::get('/login/dashboard',[LoginController::class, 'dashboard'])->name('login.dashboard');
Route::post('/auth',[LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout',[LoginController::class, 'logout'])->name('login.logout');
//fim do login


//inicio rota estoque feito por Ana
Route::get('/material/cadastrar', [MaterialController::class, 'verMaterial'])->name("ver.material");
Route::get('/material/adicionar/{id}', [MaterialController::class, 'verMaterialAdicionado'])->name("ver.material");
Route::get('/material/remover/{id}', [MaterialController::class, 'verMaterialRemovido'])->name('ver.materialRemovido');
Route::get('/material/update/{id}', [MaterialController::class, 'verMaterialAtualizado'])->name('ver.materialAtualizado');
Route::get('/material/{id}', [MaterialController::class, 'verMaterialDeletado'])->name('ver.materialDeletado');
Route::post('/material/cadastrar', [MaterialController::class, 'storeMaterial'])->name("registrar.material");
Route::post('/material/adicionar/{id}', [MaterialController::class, 'adicionarEstoque'])->name("adicionar.material");
Route::post('/material/remover/{id}', [MaterialController::class, 'removerEstoque'])->name("remover.material");
Route::put('/material/update/{id}', [MaterialController::class, 'updateMaterial'])->name("atualizar.material");
Route::delete('/material/{id}', [MaterialController::class, 'destroyMaterial'])->name("deletar.material");
//fim rota estoque


//obras feito por Diego
Route::post('/obras', [ObraController::class, 'store'])->name('obra.store');
Route::post('/obras/{id}/foto', [ArquivoController::class, 'store'])->name('foto.store');
Route::delete('/obras/{id}/foto/{ida}', [ArquivoController::class, 'destroy'])->name('foto.destroy');
Route::get('/projeto/download/{ida}', [ArquivoController::class, 'download'])->name('arquivo.download');
Route::get('/obras/{id}', [ObraController::class, 'dashboard'])->name('obra.dashboard');
Route::get('/obras/{id}/desativar', [ObraController::class, 'desativar'])->name('obra.desativar');
Route::get('/obras/{id}/editar', [ObraController::class, 'edit'])->name('obra.editar');
Route::put('/obras/{id}/editar', [ObraController::class, 'update'])->name('obra.update');
Route::get('/obras/{id}/foto', [ObraController::class, 'foto'])->name('obra.foto');
Route::get('/obras/{id}/arquivo', [ObraController::class, 'arquivo'])->name('obra.arquivo');
Route::get('/SiteIndexDiego', [SiteDashboardController::class, 'dashboard'])->name('site.index');
Route::get('/criarobra', [SiteDashboardController::class, 'criarobra'])->name('site.criarobra');
Route::get('/desativadas', [SiteDashboardController::class, 'desativadas'])->name('site.desativadas');
//fim de obras


//Atividades feito por thauan
Route::post('/atividade/atividade_form', [AtividadesController::class, 'adicionarAtividade'])->name('atividades.adicionarAtividade');
//Route::get('/criar_atv', [SiteManagaThauan::class,'criar_atv'])->name('criar_atv');
Route::put('atualizarAtividade/{idAtividade}', [AtividadesController::class, 'atualizarAtividade'])->name('atualizarAtividade');
//Route::get('/THManagaIndex', [SiteManagaThauan::class,'index'])->name('index');
//Route::get('/obras/criar_Obra', [ObraController::class,'create'])->name('Obras.criar');
Route::get('listar_atv', [AtividadesController::class, 'Listar_ATV_Obra'])->name('listar_atv');
Route::get('delete_atv/{idAtividade}', [AtividadesController::class, 'delete_atv'])->name('delete_atv');
Route::get('editar_atv/{idAtividade}', [AtividadesController::class, 'editar_atv'])->name('editar_atv');
//Fim de atividades
