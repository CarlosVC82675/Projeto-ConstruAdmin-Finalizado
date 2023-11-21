@extends('obra/layout')
@section('title','Editando')
@section('conteudo')

<H1>Editando Obra</H1>
@if($errors->any())
@foreach ($errors->all() as $error)
{{$error}} <br>
@endforeach
@endif
<div style="display:flex;justify-content:center;width:100%">
<form style="display:flex; flex-direction:column" method="post" action="{{ route('obra.update',['id' => $obra->idObras]) }}">
    @csrf
    @method('put')
    <label>nome:</label>
    <input type="text" name="nome" required value="{{$obra->nome}}">
    <input type="hidden" name="status" value="Andamento">
    <label>descrição:</label>
    <input type="text" name="descricao" required value="{{$obra->descricao}}">
    <label>tamanho da obra (em metros):</label>
    <input type="text" name="tamanho" required value="{{$obra->tamanho}}">
    <label >Tipo da Obra         Atual:{{$obra->tipo}}</label>
    <label >Residencial</label>
    <input type="radio" name="tipo" value="Residencial" >
    <label >Comercial</label>
    <input type="radio"  name="tipo" value="Comercial">
    <label >Industrial</label>
    <input type="radio"  name="tipo" value="Industrial">
    <label >Infraestrutura</label>
    <input type="radio"  name="tipo" value="Infraestrutura">
    <label >Saneamento</label>
    <input type="radio"  name="tipo" value="Saneamento">
    <label >Restauro</label>
    <input type="radio"  name="tipo" value="Restauro">
    <label>Logradouro:</label>
    <input type="text" name="logradouro" required value="{{$obra->logradouro}}">
    <label>Numero Residencial:</label>
    <input type="text" name="numResidencial" required value="{{$obra->numResidencial}}">
    <label>Bairro:</label>
    <input type="text" name="bairro" required value="{{$obra->bairro}}">
    <label>Cidade:</label>
    <input type="text" name="cidade" required value="{{$obra->cidade}}">
    <label>Estado:</label>
    <input type="text" name="estado" required value="{{$obra->estado}}">
    <label>Cep:</label>
    <input type="text" name="cep" required value="{{$obra->cep}}">
    <label>Estrutura        Atual:{{$obra->estrutura}}</label>
    <label >Metalica</label>
    <input type="radio" name="estrutura" value="Metálica">
    <label >Concreto</label>
    <input type="radio"  name="estrutura" value="Concreto">
    <label >Madeira</label>
    <input type="radio"  name="estrutura" value="Madeira">
    <label>Proposito</label>
    <input type="text" name="proposito" required value="{{$obra->proposito}}">
    <label >Data Estimada de Termino</label>
    <input type="date" name="dtFinal" value="{{$obra->dtFinal}}" min="2020-01-01" max="2024-12-31" />
    <label >Data de inicio</label>
    <input type="date" name="dtInicial" value="{{$obra->dtInicial}}" min="2020-01-01" max="2024-12-31" />
   
    <button style="max-width: 30%;margin-top:10px" type="submit">Salvar</button>
</form>
</div>


@endsection