<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\obras;
use App\Models\arquivo;
use Illuminate\Validation\Rule;


class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Dashboard($id)
    {

            $obra = Obras::find($id);

            if (!$obra) {
                abort(404); // Ou redirecione para uma página de erro 404
            }

            return view('site.siteObra.obra.dashboard', compact('obra'));
        }

        public function foto($id)
        {

            $obra = Obras::find($id);
            $arquivos = $obra->arquivo;

            if (!$obra) {
                abort(404); // Ou redirecione para uma página de erro 404
            }


                return view('site.siteObra.arquivos.foto',compact('obra','arquivos'));
            }
            public function arquivo($id)
            {

                $obra = Obras::find($id);
                $arquivos = $obra->arquivo;

                if (!$obra) {
                    abort(404); // Ou redirecione para uma página de erro 404
                }


                    return view('obra.arquivo',compact('obra','arquivos'));
                }

         public function desativar($id){
            $obra = Obras::find($id);
            $obra->update(['status' => 'Finalizado']);
            return redirect()->route('site.index');
         }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $obra = $request->validate([

            'nome'=>['required','string','unique:obras,nome','max:50'],
            'status'=>['required','in:Andamento,Finalizado'],
            'descricao'=>['required','string'],
            'tamanho'=>['required','string','regex:/^\d+(\,\d{2})?$/'],
            'tipo'=>['required','in:Residencial,Comercial,Industrial,Infraestrutura,Saneamento,Restauro'],
            'logradouro'=>['required','string','max:100','regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'numResidencial'=>['required','string','max:100','regex:/^[0-9]+$/'],
            'bairro'=>['required','string','max:100','regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'cidade'=>['required','string','max:80','regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'estado'=>['required','string','max:80','regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'cep'=>['required','string','regex:/^\d{5}-\d{3}$/'],
            'estrutura'=>['required','in:Metálica,Concreto,Madeira'],
            'proposito'=>['required','string'],
            'dtFinal'=>['date'],
            'dtInicial'=>['required','date'],

        ],[
            'nome.max' => 'O limite de caracteres para Nome é 50',
            'nome.unique' => 'Esse nome já existe, tente outro',
            'tamanho.regex' => 'Formato invalido no Tamanho, use numeros positivos',
            'logradouro.max' => 'O limite de caracteres para Logradouro é 100',
            'logradouro.regex' => 'Formato invalido no Logradouro, use apenas letras',
            'numResidencial.max' => 'O limite de caracteres para Número Residencial é 100',
            'numResidencial.regex' => 'Formato invalido no Número Residencial, use números positivos com até duas casas decimais',
            'bairro.max' => 'O limite de caracteres para bairro é 100',
            'cidade.max' => 'O limite de caracteres para cidade é 80',
            'estado.max' => 'O limite de caracteres para estado é 80',
            'bairro.regex' => 'Formato invalido no Bairro, use apenas letras',
            'cidade.regex' => 'Formato invalido na Cidade, use apenas letras',
            'estado.regex' => 'Formato invalido no Estado, use apenas letras',
            'cep.regex' => 'Formato invalido no CEP, use o formato xxxxx-xxx',

            'nome.required' => 'Preencha o campo Nome',
            'status.required' => 'Preencha o campo Status',
            'descricao.required' => 'Preencha o campo Descrição',
            'tamanho.required' => 'Preencha o campo Tamanho',
            'tipo.required' => 'Preencha o campo Tipo',
            'logradouro.required' => 'Preencha o campo Logradouro',
            'numResidencial.required' => 'Preencha o campo Numero Residencial',
            'bairro.required' => 'Preencha o campo Bairro',
            'cidade.required' => 'Preencha o campo Cidade',
            'estado.required' => 'Preencha o campo Estado',
            'cep.required' => 'Preencha o campo CEP',
            'estrutura.required' => 'Preencha o campo Estrutura',
            'proposito.required' => 'Preencha o campo Proposito',
            'dtInicial.required' => 'Preencha o campo Data Inicial',



        ]


    );



        Obras::create($obra);
        return redirect()->route('site.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $obra = Obras::find($id);
        return view('site.siteObra.obra.editar',compact('obra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $obra = Obras::find($id);

        $obraT = $request->validate([

            'nome'=>['required','string','max:50',Rule::unique('obras','nome')->ignore($obra->idObras, 'idObras')],
            'status'=>['required','in:Andamento,Finalizado'],
            'descricao'=>['required','string'],
            'tamanho'=>['required','string','regex:/^\d+(\,\d{2})?$/'],
            'tipo'=>['in:Residencial,Comercial,Industrial,Infraestrutura,Saneamento,Restauro'],
            'logradouro'=>['required','string','max:100','regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'numResidencial'=>['required','string','max:100','regex:/^[0-9]+$/'],
            'bairro'=>['required','string','max:100','regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'cidade'=>['required','string','max:80','regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'estado'=>['required','string','max:80','regex:/^[a-zA-ZÀ-ú\s]+$/'],
            'cep'=>['required','string','regex:/^\d{5}-\d{3}$/'],
            'estrutura'=>['in:Metálica,Concreto,Madeira'],
            'proposito'=>['required','string'],
            'dtFinal'=>['required','date'],
            'dtInicial'=>['required','date'],
        ],[
            'nome.max' => 'O limite de caracteres para Nome é 50',
            'nome.unique' => 'Esse nome já existe, tente outro',
            'tamanho.regex' => 'Formato invalido no Tamanho, use numeros positivos',
            'logradouro.max' => 'O limite de caracteres para Logradouro é 100',
            'logradouro.regex' => 'Formato invalido no Logradouro, use apenas letras',
            'numResidencial.max' => 'O limite de caracteres para Número Residencial é 100',
            'numResidencial.regex' => 'Formato invalido no Número Residencial, use números positivos com até duas casas decimais',
            'bairro.max' => 'O limite de caracteres para bairro é 100',
            'cidade.max' => 'O limite de caracteres para cidade é 80',
            'estado.max' => 'O limite de caracteres para estado é 80',
            'bairro.regex' => 'Formato invalido no Bairro, use apenas letras',
            'cidade.regex' => 'Formato invalido na Cidade, use apenas letras',
            'estado.regex' => 'Formato invalido no Estado, use apenas letras',
            'cep.regex' => 'Formato invalido no CEP, use o formato xxxxx-xxx',

            'nome.required' => 'Preencha o campo Nome',
            'status.required' => 'Preencha o campo Status',
            'descricao.required' => 'Preencha o campo Descrição',
            'tamanho.required' => 'Preencha o campo Tamanho',
            'tipo.required' => 'Preencha o campo Tipo',
            'logradouro.required' => 'Preencha o campo Logradouro',
            'numResidencial.required' => 'Preencha o campo Numero Residencial',
            'bairro.required' => 'Preencha o campo Bairro',
            'cidade.required' => 'Preencha o campo Cidade',
            'estado.required' => 'Preencha o campo Estado',
            'cep.required' => 'Preencha o campo CEP',
            'estrutura.required' => 'Preencha o campo Estrutura',
            'proposito.required' => 'Preencha o campo Proposito',
            'dtFinal.required' => 'Preencha o campo Data Final',
            'dtInicial.required' => 'Preencha o campo Data Inicial',



        ]
    );

        $obra->update($obraT);
        return redirect()->route('obra.dashboard', ['id' => $id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
