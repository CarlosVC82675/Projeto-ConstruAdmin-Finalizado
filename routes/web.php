<?php


use App\Http\Controllers\ListaObrasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiteDashboardController;
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
Route::view('/layoutFora', 'layoutFora')->name('Area.Trabalho');
Route::view('/layoutdentro', 'layoutdentro')->name('obraDentro.layout');


//usuarios feito por Carlos
Route::get('/usuario/lista',[UsuariosController::class, 'index'])->name("lista.usuarios");
Route::get('/usuario/cadastro',[UsuariosController::class, 'create'])->name("cadastro.usuarios");
Route::get('/usuario/show/{id}',[UsuariosController::class, 'show'])->name("ver.usuarios");
Route::get('/usuario/edit/{id}',[UsuariosController::class, 'edit'])->name("editar.usuarios");
Route::post('/usuario/store',[UsuariosController::class, 'store'])->name("usuarios.cadastrar");
Route::put('/usuario/update/{id}',[UsuariosController::class, 'update'])->name("atualizar.usuario");
Route::delete('/usuario/delete/{id}',[UsuariosController::class, 'destroy'])->name("deletar.usuarios");
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
Route::get('/menu', [SiteDashboardController::class, 'dashboard'])->name('site.index');
Route::get('/obra/criar', [SiteDashboardController::class, 'criarobra'])->name('site.criarobra');
Route::get('/obra/cadastrando', [SiteDashboardController::class, 'clientes'])->name('site.cliente');
Route::get('/obra/associando', [SiteDashboardController::class, 'associar'])->name('site.associar');
Route::get('/obra/desativadas', [SiteDashboardController::class, 'desativadas'])->name('site.desativadas');
Route::get('/projeto/download/{ida}', [ArquivoController::class, 'download'])->name('arquivo.download');
Route::get('/projeto/visualizar/{ida}', [ArquivoController::class, 'visualizar'])->name('arquivo.visualizar');
Route::get('/obra/{id}', [SiteDashboardController::class, 'dashboardDentro'])->name('obra.dashboard');
Route::get('/obra/{id}/desativar', [ObraController::class, 'desativar'])->name('obra.desativar');
Route::get('/obra/{id}/foto', [SiteDashboardController::class, 'foto'])->name('obra.foto');
Route::get('/obra/{id}/arquivo', [SiteDashboardController::class, 'arquivo'])->name('obra.arquivo');
Route::get('/obra/{id}/editar', [SiteDashboardController::class, 'edit'])->name('obra.editar');
Route::post('/obra', [ObraController::class, 'store'])->name('obra.store');
Route::post('/obra/cliente', [UsuariosController::class, 'store'])->name('cliente.cadastrar');
Route::post('/obra/associar', [ListaObrasController::class, 'associarVariosUsuarios'])->name('funcionario.associar');
Route::post('/obra/{id}/foto', [ArquivoController::class, 'store'])->name('foto.store');
Route::put('/obra/{id}/editar', [ObraController::class, 'update'])->name('obra.update');
Route::delete('/obra/{id}/foto/{ida}', [ArquivoController::class, 'destroy'])->name('foto.destroy');
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
