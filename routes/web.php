<?php


use App\Http\Controllers\SiteController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ArquivoController;

use Illuminate\Support\Facades\Route;


Route::post('/obras', [ObraController::class, 'store'])->name('obra.store');
Route::post('/obras/{id}/arquivo', [ArquivoController::class, 'store'])->name('arquivo.store');
Route::get('/obras/{id}', [ObraController::class, 'dashboard'])->name('obra.dashboard');
Route::get('/obras/{id}/arquivo', [ObraController::class, 'arquivo'])->name('obra.arquivo');
Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/criarobra', [SiteController::class, 'criarobra'])->name('site.criarobra');
Route::get('/verobras', [SiteController::class, 'verobras'])->name('site.verobras');

