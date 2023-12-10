@extends('site.siteMenu.layoutFora')
@section('conteudo')
<H1>Começe uma obra</H1>
<a href="{{route('site.criarobra')}}">Criar Obra</a> <a href="{{route('site.desativadas')}}">Ver Obras Desativadas</a>
<H1>lista de obras</H1>


    @if($obras->isEmpty() || $obras->filter(function ($obra) {return $obra->status !== 'Finalizado';})->isEmpty())
        <p>Nenhuma obra registrada ou ativa</p>
    @else
        <ul>
            @foreach ($obras as $obra)
                @if($obra->status!='Finalizado')
                <li>
                    <strong>{{ $obra->nome }} </strong> <a href="{{route('obra.dashboard', ['id' => $obra->idObras])}}">Acessar</a>
                </li>
                @else
                @endif
            @endforeach
        </ul>
    @endif
@endsection
