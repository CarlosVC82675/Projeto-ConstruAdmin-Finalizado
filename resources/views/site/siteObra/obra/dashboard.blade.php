@extends('site.siteObra.layoutdentro')
@section('title','dashboard')
@section('conteudo')


<div style="display:flex;justify-content:center;width:100%">
@if($obra->status !== 'Finalizado')
<a href="{{route('obra.editar', ['id' => $obra->idObras])}}">Editar Obra</a>
<a href="{{route('obra.desativar', ['id' => $obra->idObras])}}">desativar Obra</a>
@endif
</div>
@endsection
