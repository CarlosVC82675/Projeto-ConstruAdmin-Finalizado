<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obras;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ListaObrasController extends Controller
{
//NAO TESTADO, FINALIZADO
public function associarAObra($idObra, $idUsuario)
{
    //procurar os ids

        $obra = Obras::findOrFail($idObra);
        $usuario = Usuario::findOrFail($idUsuario);

    //----------------------------------------------------------------------------

    if ($usuario->obras()->count() > 0 && $usuario->hasAnyRole('Apontador','Engenheiro','Comum')->obras()->count() > 0){
        return redirect()->back()->with('error','Esse Usuario já esta associado com alguma obra em andamento.');
    } else {
    try {
        DB::beginTransaction();

        $obra->usuarios()->attach($idUsuario);

        DB::commit();
        }catch (\PDOException $erro) {
            $errorCode = $erro->getCode();
            if ($errorCode === '2002' || $errorCode === '1045' || $errorCode === '1049') {

        // Desfaz a transação em caso de erro
        DB::rollBack();
        return redirect()->back()->with('error', 'Ocorreu um erro ao tentar se conectar ao banco, por favor consulte o suporte');
            }
        }
    }





}

public function desassociarUsuario($idObra, $idUsuario)
{
    //procurar os ids

        $obra = Obras::findOrFail($idObra);
        $usuario = Usuario::findOrFail($idUsuario);

    //----------------------------------------------------------------------------

    if ($usuario->obras()->count() > 0 && $usuario->hasAnyRole('Apontador','Engenheiro','Comum')->obras()->count() > 0){
        return redirect()->back()->with('error','Esse Usuario já esta associado com alguma obra em andamento.');
    } else {
    try {
        DB::beginTransaction();

        $obra->usuarios()->detach($idUsuario);

        DB::commit();
        }catch (\PDOException $erro) {
            $errorCode = $erro->getCode();
            if ($errorCode === '2002' || $errorCode === '1045' || $errorCode === '1049') {

        // Desfaz a transação em caso de erro
        DB::rollBack();
        return redirect()->back()->with('error', 'Ocorreu um erro ao tentar se conectar ao banco, por favor consulte o suporte');
            }
        }
    }





}



    public function associarVariosUsuarios(Request $request)
   {
    $obraId = $request->input('obra_id');
    $usuariosIds = $request->input('usuarios');

    



    try {
        $obra = Obras::findOrFail($obraId);
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








   }


//Fazer funções para lista usuarios da obra, e obras de usuarios
}
