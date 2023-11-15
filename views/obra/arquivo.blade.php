@extends('obra/layout')
@section('title','dashboard')
@section('conteudo')

<H1>Adicione o arquivo</H1>

<form style="display:flex; flex-direction:column" method="post" enctype="multipart/form-data" action="{{ route('arquivo.store',['id' => $obra->idObras]) }}">
    @csrf
<label>Coloque o arquivo</label>
<input type="file" name="arquivo" accept="image/*">

<input type="hidden" name="Obras_IdObras" value="{{$obra->IdObras}}">

<button style="max-width: 30%;margin-top:10px" type="submit">Salvar</button>
</form>

@if($arquivos->isEmpty())
        <p>Nenhum Projeto Encontrado</p>
    @else
        <ul>
            @foreach ($arquivos as $arquivo)
                <li>
                    <img src="{{ url("storage/{$arquivo->arquivo}") }}" alt="">
                    
                </li>
            @endforeach
        </ul>
    @endif





@endsection