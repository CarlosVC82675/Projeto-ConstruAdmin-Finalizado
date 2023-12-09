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
    public function associarUsuarioAObra($idObra, $idUsuario)
    {
        //procurar os ids
        try {
            $obra = Obras::findOrFail($idObra);
            $usuario = Usuario::findOrFail($idUsuario);

        } catch (ModelNotFoundException $exception) {
        // tratar o caso quando o usuário não é encontrado
            return redirect()->back()->with('error',
            'O Usuário ou a obra paracem invalidos, guarde o codigo do erro e consulte o suporte .');
        }
        //----------------------------------------------------------------------------

        if ($usuario->obras()->count() > 0 && $usuario->atribuicao_Usuario_id_Atribuicao != 1){
            return redirect()->back()->with('error 0041A',
            'O Usuário ou a obra paracem invalidos, guarde o codigo do erro e consulte o suporte .');
        } else {
        // Associando usuário à obra(attach quando associar 1 por 1)
        try {
            DB::beginTransaction();

            $obra->usuarios()->attach($idUsuario);

            DB::commit();
            }catch (\PDOException $erro) {
                $errorCode = $erro->getCode();
                if ($errorCode === '2002' || $errorCode === '1045' || $errorCode === '1049') {

            // Desfaz a transação em caso de erro
            DB::rollBack();
            return redirect()->back()->with('error5002E', 'Ocorreu um erro ao tentar se conectar ao banco, por favor consulte o suporte');
                }
            }
        }

    }


    public function desassociarUsuario($idObra, $idUsuario)
    {
         //procurar os ids
        try {
            $obra = Obras::findOrFail($idObra);
            $usuario = Usuario::findOrFail($idUsuario);

        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error',
            'O Usuário ou a obra paracem invalidos, guarde o codigo do erro e consulte o suporte .');
        }
        //----------------------------------------------------------------------------
        //dessassociar Usuario a obra
        try {
            DB::beginTransaction();
        

            $obra->usuarios()->detach($idUsuario);

            DB::commit();
            }catch (\PDOException $erro) {
                $errorCode = $erro->getCode();
                if ($errorCode === '2002' || $errorCode === '1045' || $errorCode === '1049') {

            // Desfaz a transação em caso de erro
            DB::rollBack();
            return redirect()->back()->with('error5002E', 'Ocorreu um erro ao tentar se conectar ao banco, por favor consulte o suporte');
                }
            }
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


//Fazer funções para lista usuarios da obra, e obras de usuarios
}
