@extends('site.siteObra.layoutdentro')
@section('title','Fotos')

@section('conteudo')
<div style="padding: 25px">
<H1>Seção de Fotos</H1>
@if($errors->any())
@foreach ($errors->all() as $error)
{{$error}} <br>
@endforeach
@endif
@if($obra->status !== 'Finalizado')

<form class="row g-3" method="post" enctype="multipart/form-data" action="{{route('foto.store',['id' => $obra->idObras]) }}">
    @csrf
    <input type="hidden" name="Obras_IdObras" value="{{$obra->idObras}}">
    <input type="hidden" name="tipo" value="1">

    <div class="col-md-6">
      <label  class="form-label">O nome da sua foto</label>
      <input type="text" name="nome" class="form-control" id="" required>
    </div>
    <div class="col-md-6">
        <label  class="form-label">Coloque seu arquivo</label>
             <div class="input-group ">
            <input type="file" class="form-control" name="caminho" accept=".png,.jpg,.jpeg" required>
            <button class="input-group-text" >Upload</button>
          </div>
        </div>

</form>




@else
<h1>Não é possivel modificar</h1>
@endif

    @if($arquivos->isEmpty())
        <p>Nenhum Projeto Encontrado</p>
        @else


    <div class="container mt-4">
        <h1 class="display-1 text-center mb-4"><strong>Suas Fotos</strong></h1>
        <div class="row">
            @foreach ($arquivos as $arquivo)
            @if($arquivo->tipo == 1)

        <div class="col-sm-12 col-md-6 col-lg-4">
            <h3 class="text-center">{{$arquivo->nome}} </h3>
        <img class="img-fluid object-fit-xxl-contain mb-4 shadow rounded" src="{{ secure_asset("app/public/{$arquivo->caminho}") }}"  id="reco"  alt="imagem 01" >

        <div class="row d-flex justify-content-between">

            <div class="col-4">
                <form class="form-group" method="post" enctype="multipart/form-data" action="{{route('arquivo.visualizar',['ida'=>$arquivo->idArquivo])}}">
                @csrf
                @method('get')
                <button type="submit" class="btn btn-primary">Visualizar</button>
                </form>
            </div>

        <div class="col-4">
            <form class="form-group" method="post" enctype="multipart/form-data" action="{{route('arquivo.download',['ida'=>$arquivo->idArquivo])}}">
            @csrf
            @method('get')
            <button type="submit" class="btn btn-primary">Download</button>
            </form>
        </div>

        <div class="col-4 w-auto">
            @if($obra->status=='Andamento')
            <form class="form-group" method="post" enctype="multipart/form-data" action="{{route('foto.destroy',['id'=>$obra->idObras,'ida'=>$arquivo->idArquivo])}}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" >Excluir</button>
            </form>
            @endif
        </div>

        </div>
        </div>
        @endif
        @endforeach

        </div>
    </div>



        @endif

</div>
@endsection
