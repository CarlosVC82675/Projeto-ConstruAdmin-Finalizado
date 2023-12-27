<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obras;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;

class ListaObrasController extends Controller
{
    protected $userService;

    //injeção de dependencia
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    
    public function associarVariosUsuarios(Request $request)
   {

    $ultimaobra=Obras::latest()->first();
    $ultimoidobra= $ultimaobra->idObras;
    $ultimocliente=Usuario::latest()->first();
    $ultimoidcliente=$ultimocliente->idUsuario;


    $usuariosIds = $request->input('usuarios');
    array_push($usuariosIds,$ultimoidcliente);

    try {
        $obra = Obras::findOrFail($ultimoidobra);
    } catch (ModelNotFoundException $exception) {
        return redirect()->back()->with('error',
        'O Usuário ou a obra paracem invalidos, guarde o codigo do erro e consulte o suporte .');
    }

    //associar os usuarios
    try {
    DB::beginTransaction();

    $obra->usuarios()->sync($usuariosIds);

    DB::commit();
    }catch (\PDOException $erro) {
        $errorCode = $erro->getCode();
        if ($errorCode === '2002' || $errorCode === '1045' || $errorCode === '1049') {

    // Desfaz a transação em caso de erro
    DB::rollBack();
    return redirect()->back()->with('error', 'Ocorreu um erro ao tentar se conectar ao banco, por favor consulte o suporte');
        }
    }

    return redirect()->route('site.index');
   }

   public function associarVariosUsuariosDashboard(Request $request)
   {
    // Recebendo os IDs dos usuários e o ID da obra
    $usuariosIds = $request->input('usuarios');
    $obraId = $request->input('obra_id');

    try {
        $obra = Obras::findOrFail($obraId);
    } catch (ModelNotFoundException $exception) {
        return redirect()->back()->with('error', 'A obra parece ser inválida.');
    }

    // Obtendo os usuários associados atualmente
    $usuariosAtuais = $obra->usuarios->pluck('id')->toArray();

    // Filtrando os IDs dos usuários para adicionar apenas os novos
    $usuariosParaAdicionar = array_diff($usuariosIds, $usuariosAtuais);

    // Associando os novos usuários à obra
    $obra->usuarios()->attach($usuariosParaAdicionar);

    return redirect()->route('site.index');
    }

    public function desassociarVariosUsuariosDashboard(Request $request)
    {
        // Recebendo os IDs dos usuários e o ID da obra
        $usuariosIds = $request->input('usuarios');
        $obraId = $request->input('obra_id');

        try {
            $obra = Obras::findOrFail($obraId);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'A obra parece ser inválida.');
        }

        // Desassociando os usuários da obra
        $obra->usuarios()->detach($usuariosIds);

        return redirect()->route('site.index');
    }


//Fazer funções para lista usuarios da obra, e obras de usuarios
}
