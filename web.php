<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Models\Materiais_Estoque;

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

Route::get('/', function () {
    return view('welcome');
});
//inicio rota estoque
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
