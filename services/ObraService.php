<?php

namespace App\Services;


use App\Models\Obras;
use Illuminate\Support\Facades\DB;

class ObraService
{
    protected $exceptionHandler;

    public function __construct(ExceptionHandlerService $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    public function cadastrarObra($request)
    {
        try {
            DB::beginTransaction();

            Obras::create($request->all());

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->exceptionHandler->handleException($exception);
        }
    }

    public function atualizarObra($request, $obra)
    {
        try {
            DB::beginTransaction();

            $obra->update($request->all());

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->exceptionHandler->handleException($exception);
        }
    }

    public function desativar($obra)
    {
        try {
            DB::beginTransaction();

            $obra->update(['status' => 'Finalizado']);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->exceptionHandler->handleException($exception);
        }
    }

    public function buscarObraId($id)
    {
        try {
            $obra = Obras::findOrFail($id);
            return $obra;
        } catch (\Exception $exception) {
            $this->exceptionHandler->handleException($exception);
        }
    }
}
