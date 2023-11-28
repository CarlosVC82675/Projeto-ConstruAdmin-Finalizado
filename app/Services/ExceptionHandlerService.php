<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ExceptionHandlerService
{
    public function handleException($error){
       if ($error instanceof QueryException) {
            $errorCode = $error->getCode();
            if ($errorCode === '23000') {
                throw new \Exception('Este registro não pode ser inserido ou deletado.', $errorCode);
            } else {
                throw new \Exception('Ocorreu um erro na base de dados.', $errorCode);
            }
        }elseif ($error instanceof \PDOException) {
            throw new \Exception('Erro na conexão com o banco de dados.');
        } elseif($error instanceof ModelNotFoundException) {
            $modelName = $error->getModel();
            throw new \Exception("O registro do modelo '$modelName' que você procurou não foi localizado.", 0, $error);
        } else {
            throw new \Exception('Ocorreu um erro desconhecido.');
        }
    }

}







