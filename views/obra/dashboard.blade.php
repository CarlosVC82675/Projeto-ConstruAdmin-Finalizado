@extends('obra/layout')
@section('title','dashboard')
@section('conteudo')








<div>
@if($obra->status !== 'Finalizado')
<a href="{{route('obra.editar', ['id' => $obra->idObras])}}">Editar Obra</a>
<a href="{{route('obra.desativar', ['id' => $obra->idObras])}}">desativar Obra</a>
@endif
</div>
@endsection