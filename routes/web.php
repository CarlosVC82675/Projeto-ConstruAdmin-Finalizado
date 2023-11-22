<?php


use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ListaObrasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\LoginController;
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


//USUARIOS{

// Views
Route::get('/usuario/lista',[UsuariosController::class, 'index'])->name("lista.usuarios");

Route::get('/usuario/cadastro',[UsuariosController::class, 'create'])->name("cadastro.usuarios");

Route::get('/usuario/show/{id}',[UsuariosController::class, 'show'])->name("ver.usuarios");

Route::get('/usuario/edit/{id}',[UsuariosController::class, 'edit'])->name("editar.usuarios");

//Cadastrar
Route::post('/usuario/store',[UsuariosController::class, 'store'])->name("cadastrar.usuarios");

//Atualizar
Route::put('/usuario/update/{id}',[UsuariosController::class, 'update'])->name("atualizar.usuario");

//Deletar
Route::delete('/usuario/delete/{id}',[UsuariosController::class, 'destroy'])->name("deletar.usuarios");

// }FIM DE USUARIOS

//LOGIN{

Route::get('/login',[LoginController::class, 'index'])->name('login.form');

Route::get('/login/dashboard',[LoginController::class, 'dashboard'])->name('login.dashboard');

Route::post('/auth',[LoginController::class, 'auth'])->name('login.auth');

Route::get('/logout',[LoginController::class, 'logout'])->name('login.logout');

// }FIM DO LOGIN
