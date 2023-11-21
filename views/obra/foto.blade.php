@extends('obra/layout')
@section('title','Fotos')
@section('conteudo')

<H1>Seção de Fotos</H1>
@if($errors->any())
@foreach ($errors->all() as $error)
{{$error}} <br>
@endforeach
@endif
@if($obra->status !== 'Finalizado')
<h3>Adicione seus arquivos</h3>
<form style="display:flex; flex-direction:column" method="post" enctype="multipart/form-data" action="{{route('foto.store',['id' => $obra->idObras]) }}">
    @csrf
<label>Coloque o nome do seu arquivo</label>
<input type="text" name="nome" required>
<input type="file" name="caminho" accept="image/*" required>
<input type="hidden" name="Obras_IdObras" value="{{$obra->idObras}}">
<input type="hidden" name="tipo" value="1">

<button style="max-width: 30%;margin-top:10px" type="submit">Salvar</button>
</form>
@else
<h1>Não é possivel modificar</h1>
@endif

@if($arquivos->isEmpty())
        <p>Nenhum Projeto Encontrado</p>
    @else
        
            @foreach ($arquivos as $arquivo)
            @if($arquivo->tipo == 1)
            <div>
                <ul>
                    <div style="display:flex">  
                    <img src="{{ url("storage/{$arquivo->caminho}") }}" alt="">

                    <div style="display:flex; flex-direction:column;width:20%;justify-content:center">
                    <p>{{$arquivo->nome}}</p>
                    @if($obra->status !== 'Finalizado')
                        <form style="display:flex; flex-direction:column" method="post" enctype="multipart/form-data" action="{{route('arquivo.download',['ida'=>$arquivo->idArquivo])}}">
                            @csrf
                            @method('get')
                            <button style="max-width: 100%;margin-top:10px" type="submit">download</button>
                        </form>
                        <form style="display:flex; flex-direction:column" method="post" enctype="multipart/form-data" action="{{route('foto.destroy',['id'=>$obra->idObras,'ida'=>$arquivo->idArquivo])}}">
                            @csrf
                            @method('delete')
                            <button style="max-width: 100%;margin-top:10px" type="submit">deletar</button>
                        </form>
                </div>
                    @endif
                </ul>
            </div>
            @endif
            @endforeach
        
    @endif


  


@endsection