<?php


use App\Http\Controllers\SiteController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ArquivoController;

use Illuminate\Support\Facades\Route;


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
Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/criarobra', [SiteController::class, 'criarobra'])->name('site.criarobra');
Route::get('/verobras', [SiteController::class, 'verobras'])->name('site.verobras');
Route::get('/desativadas', [SiteController::class, 'desativadas'])->name('site.desativadas');

