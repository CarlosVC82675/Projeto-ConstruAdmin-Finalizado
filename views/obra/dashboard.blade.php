@extends('obra/layout')
@section('title','dashboard')
@section('conteudo')


<h1>Dashboard da Obra</h1>

<strong>ID da Obra:</strong> {{ $obra->idObras }} <br>
<strong>Nome da Obra:</strong> {{ $obra->nome }} <br>


<a href="{{route('obra.arquivo', ['id' => $obra->idObras])}}">Projeto</a>



@endsection