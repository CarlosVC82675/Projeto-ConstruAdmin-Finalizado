<?php
//Feito por diego
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arquivo;
use App\Services\ArquivoService;
use App\Services\ExceptionHandlerService;
use App\Services\UserService;


class ArquivoController extends Controller
{
    protected $ArquivoService;
    protected $exceptionHandler;
    protected $userService;

    public function __construct(UserService $userService, ArquivoService $ObraService,  ExceptionHandlerService $exceptionHandler)
    {
        $this->ArquivoService = $ObraService;
        $this->exceptionHandler = $exceptionHandler;
        $this->userService = $userService;
    }

    // Salva o arquivo no banco e na pasta do storage, sendo arquivo ou foto
    public function store(Request $request, $id)
    {
    if($this->userService->VerificarPermissao('Projeto')){
        try {

            $this->validarArquivo($request);

            $this->ArquivoService->cadastrarArquivo($request, $id);

            if ($request->tipo == 1) {
                return redirect()->route('obra.foto', ['id' => $id]);
            } else {
                return redirect()->route('obra.arquivo', ['id' => $id]);
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();  // Isso imprimir a mensagem da exceção
            return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }
    }

    //Destroi o arquivo ou foto
    public function destroy($id, $ida)
    {
    if($this->userService->VerificarPermissao('Projeto')){
        try {
            $arquivo = $this->ArquivoService->buscarArquivoId($ida);

            $this->ArquivoService->deletarArquivo($arquivo);


            if ($arquivo->tipo == 1) {
                return redirect()->route('obra.foto', ['id' => $id]);
            } else {
                return redirect()->route('obra.arquivo', ['id' => $id]);
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();  // Isso imprimir a mensagem da exceção
            return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }
    }

    //isso aqui faz download 👍
    public function download($ida)
    {
    if($this->userService->VerificarPermissao('DownloadProjeto')){
        try {
            $arquivo = $this->ArquivoService->buscarArquivoId($ida);

         return $this->ArquivoService->download($arquivo);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();  // Isso imprimir a mensagem da exceção
            return redirect()->back()->with('error', $errorMessage ?? 'Erro desconhecido.')->withInput();
        }
    }else{
        return redirect()->back()->with('error','Voce não tem Permissão para Fazer isso!');
    }
    }

    //isso aqui visualiza né burro do krai 👍
    public function visualizar($ida)
    {

        $arquivo = $this->ArquivoService->buscarArquivoId($ida);
        return view('site.siteObra.arquivos.visualizar', compact('arquivo'));
    }

    public function validarArquivo($request)
    {
        $request->validate([
            'nome' => ['required', 'max:50'],
            'caminho' => ['required']
        ], [
            'nome.required' => 'Prencha o campo Nome',
            'caminho.required' => 'Prencha o campo do arquivo',
            'nome.max' => 'O limite de caracteres para Nome é 50'
        ]);
    }
}
