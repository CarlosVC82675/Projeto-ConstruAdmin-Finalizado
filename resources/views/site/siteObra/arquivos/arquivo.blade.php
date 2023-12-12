@extends('site.siteObra.layoutdentro')
@section('title','Arquivos')
@section('conteudo')

<div style="padding: 25px">

<H1>Seção de Arquivos</H1>
@if($errors->any())
@foreach ($errors->all() as $error)
{{$error}} <br>
@endforeach
@endif


@if($obra->status !== 'Finalizado')
<form class="row g-3" method="post" enctype="multipart/form-data" action="{{route('foto.store',['id' => $obra->idObras]) }}">
    @csrf
    <input type="hidden" name="Obras_IdObras" value="{{$obra->idObras}}">
    <input type="hidden" name="tipo" value="2">

    <div class="col-md-6">
      <label  class="form-label">O nome do seu arquivo</label>
      <input type="text" name="nome" class="form-control" id="" required>
    </div>
    <div class="col-md-6">
        <label  class="form-label">Coloque seu arquivo</label>
             <div class="input-group ">
            <input type="file" class="form-control" name="caminho" accept=".pdf,rvt,.rfa,.dwg,.xlsx" required>
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

    <div class="table-responsive">

    <table class="table border mt-2">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Extensão</th>
            <th scope="col">Upload</th>
            <th scope="col">Açoes</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($arquivos as $arquivo)
             @if($arquivo->tipo == 2)
            <td scope="row">{{$arquivo->nome}} </td>
            <td>{{$arquivo->extensao}}</td>
            <td>{{$arquivo->created_at}}</td>
            <td>
                <div class="row">
                    <div class="col-md-4">
                <form style="form-group " method="post" enctype="multipart/form-data" action="{{route('arquivo.download',['ida'=>$arquivo->idArquivo])}}">
                    @csrf
                    @method('get')
                    <button class="btn btn-primary mb-2" style="width:  6.4rem !important" type="submit">download</button>
                </form>
            </div>
                 <div class="col-md-4">
                    @if($obra->status=='Andamento')
                <form style="form-group" method="post" enctype="multipart/form-data" action="{{route('foto.destroy',['id'=>$obra->idObras,'ida'=>$arquivo->idArquivo])}}">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" style="width:  6.4rem !important" type="submit">deletar</button>
                    @endif
                </form>

                </div>

            </div>

            </td>

          </tr>

        </tbody>
        @endif
        @endforeach
      </table>

    </div>



@endif




</div>
@endsection
