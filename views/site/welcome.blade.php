@extends('site/layout')
@section('conteudo')
<H1>Começe uma obra</H1>
<a href="{{route('site.criarobra')}}">Criar Obra</a>
<H1>lista de obras</H1>

    
    @if($obras->isEmpty())
        <p>Nenhuma obra encontrada.</p>
    @else
        <ul>
            @foreach ($obras as $obra)
                <li>
                    <strong>{{ $obra->nome }} </strong> <a href="{{route('obra.dashboard', ['id' => $obra->idObras])}}">Acessar</a> 
                </li>
            @endforeach
        </ul>
    @endif
@endsection