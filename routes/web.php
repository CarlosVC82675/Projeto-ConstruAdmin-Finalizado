<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtividadesController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\SiteManaga;

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

Route::post('/atividade/atividade_form', [AtividadesController::class, 'adicionarAtividade'])->name('atividades.adicionarAtividade');

Route::get('/criar_atv', [SiteManaga::class,'criar_atv'])->name('criar_atv');

Route::put('atualizarAtividade/{idAtividade}', [AtividadesController::class, 'atualizarAtividade'])->name('atualizarAtividade');

Route::get('/index', [SiteManaga::class,'index'])->name('index');

Route::get('/obras/criar_Obra', [ObraController::class,'create'])->name('Obras.criar');

Route::get( 'listar_atv', [AtividadesController::class, 'Listar_ATV_Obra'])->name('listar_atv');

Route::get('delete_atv/{idAtividade}', [AtividadesController::class, 'delete_atv'])->name('delete_atv');


Route::get('editar_atv/{idAtividade}', [AtividadesController::class, 'editar_atv'])->name('editar_atv');
