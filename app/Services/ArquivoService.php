<?php

namespace App\Services;

use App\Models\arquivo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ArquivoService
{

    protected $exceptionHandler;

    public function __construct(ExceptionHandlerService $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    public function cadastrarArquivo($request, $id)
    {
        try {
            DB::beginTransaction();

            $file = $request->file('caminho');
            $data['caminho'] =  $file->store('arquivo', 'public');
            $data['Obras_IdObras'] = $id;
            $data['nome'] = $request->nome;
            $data['extensao'] = $file->getClientOriginalExtension();
            $data['tipo'] = $request->tipo;

            Arquivo::create(['caminho' => $data['caminho'], 'Obras_IdObras' => $data['Obras_IdObras'], 'nome' => $data['nome'], 'tipo' => $data['tipo'], 'extensao' => $data['extensao']]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->exceptionHandler->handleException($exception);
        }
    }

    public function deletarArquivo($arquivo)
    {
        try {
            DB::beginTransaction();

            $arquivo->delete();
            File::delete(storage_path("app/public/{$arquivo->caminho}"));

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->exceptionHandler->handleException($exception);
        }
    }

    public function download($arquivo)
    {
        try {
            $tipo_mime = File::extension(storage_path("app/public/{$arquivo->caminho}"));

            return response()->download(storage_path("app/public/{$arquivo->caminho}"), $arquivo->nome . "." . $arquivo->extensao, [
                'Content-Type' => $tipo_mime,
            ]);
        } catch (\Exception $exception) {
            $this->exceptionHandler->handleException($exception);
        }
        
    }

    public function buscarArquivoId($id)
    {
        try {
            $arquivo = Arquivo::findOrFail($id);
            return $arquivo;
        } catch (\Exception $exception) {
            $this->exceptionHandler->handleException($exception);
        }
    }

    
}
