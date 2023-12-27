<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Services\TelefoneService;

class UserService
{
    protected $telefoneService;
    protected $exceptionHandler;

    public function __construct(TelefoneService $telefoneService, ExceptionHandlerService $exceptionHandler)
    {
        $this->telefoneService = $telefoneService;
        $this->exceptionHandler = $exceptionHandler;
    }

    public function  buscarTodosUsuario()
    {
        return Usuario::all();
    }

    public function buscarUsuarioPorId($Id)
    {
        try{
        $usuario = Usuario::findOrFail($Id);
        return $usuario;
        } catch (\Exception $exception) {
             $this->exceptionHandler->handleException($exception);
        }
    }

    public function criarUsuario($request)
    {
        try{
            DB::beginTransaction();
        //Filtrar Dados
        $usuarioData = $request->except('telefone1', 'telefone2', 'telefone3', 'atribuicao');
        $usuarioData['password'] = bcrypt($usuarioData['cpf']);
        $idAtribuicao = request()->input('atribuicao');


        //Mapeamento Funções
        $mapeamentoFunções = [
            1 => 'Administrador',
            2 => 'Supervisor',
            3 => 'Apontador',
            4 => 'Engenheiro',
            5 => 'Cliente',
            6 => 'Comum'
        ];

        //Criar Usuario
        if (array_key_exists($idAtribuicao, $mapeamentoFunções)) {
            $usuario = Usuario::create($usuarioData);
            $papel = $mapeamentoFunções[$idAtribuicao];
            $usuario->assignRole($papel);
        }

         //Criar Telefone
         $this->telefoneService->CriarTelefones($usuario, $request);


        DB::commit();

        return $usuario;
        } catch (\Exception $exception) {
            //dd($exception->getMessage()); feito para ver possiveis erros
            DB::rollBack();
            $this->exceptionHandler->handleException($exception);
        }
    }

    public function atualizarUsuario($usuario, $dados)
    {
        //FiltrarDados
        $usuarioAtualizado = $dados->except('telefone1', 'telefone2', 'telefone3', 'atribuicao');
        try{
        // Início da transação
        DB::beginTransaction();

        // Filtra dados vazios:
        $usuarioAtualizado = array_filter($usuarioAtualizado);

        // Atualiza os dados do usuário
        $usuario->update($usuarioAtualizado);

        $this->telefoneService->AtualizarTelefones($usuario, $dados);

        // Confirma a transação se tudo estiver correto
        DB::commit();
        } catch (\Exception $exception) {
            //dd($exception->getMessage()); feito para ver possiveis erros
            DB::rollBack();
            $this->exceptionHandler->handleException($exception);
        }

    }

    public function deletarUsuario($idusuario)
    {
        try {
        $usuario = $this->buscarUsuarioPorId($idusuario);

        if ($usuario->obras()->count() > 0) {
            throw new \Exception('Esse Usuario possui associações com algumas obras.', 10);
        } else {
            $usuario->delete();
        }

        } catch (\Exception $exception) {
          //dd($exception->getMessage()); feito para ver possiveis erros
            DB::rollBack();
            if($exception->getCode() == 10){
                throw $exception;
            }
            $this->exceptionHandler->handleException($exception);
        }


    }

    public function rolesUsuario($id){
       $usuario = $this->buscarUsuarioPorId($id);
       return $usuario->getRoleNames();
    }

    public static function filtrarFunções($Função){

        $usuarios = Usuario::all();;
        $usuariosFiltrado = [];

        foreach($usuarios as $usuario){
            if($usuario->hasrole($Função)){
                $usuariosFiltrado[] = $usuario;
            }
        }
        return $usuariosFiltrado;
    }

    public function VerificarPermissao($permissao){
        $usuario = Usuario::find(Auth::id());
        if ($usuario->hasPermissionTo($permissao)) {
            return true;
        } else {
            return false;
        }
    }


}
