@extends('site.siteMenu.layoutfora')
@section('conteudo')

@if($obras->filter(function ($obra) {return $obra->status === 'Finalizado';})->isEmpty())
<p>Nenhuma Obra Desativada</p>
@else
<ul>
    @foreach ($obras as $obra)
        @if($obra->status =='Finalizado')
        <li>
            <strong>{{ $obra->nome }} </strong> <a href="{{route('obra.dashboard', ['id' => $obra->idObras])}}">Acessar</a>
        </li>
        @endif
    @endforeach
</ul>
@endif


@endsection
