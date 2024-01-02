@extends('site.siteObra.layoutdentro')
@section('title', 'Fotos')

@section('conteudo')
    <div style="padding: 25px;height:100vh">
        <div class="d-flex justify-content-center mb-4">
            <H1 class="fw-bold">Seção de Fotos</H1>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        @endif
     

        @if ($obra->status !== 'Finalizado')
            <form class="row g-3 mb-5" method="post" enctype="multipart/form-data" id="upload"
                action="{{ route('foto.store', ['id' => $obra->idObras]) }}">
                @csrf
                <input type="hidden" name="Obras_IdObras" value="{{ $obra->idObras }}">
                <input type="hidden" name="tipo" value="1">

                <div class="col-md-6">
                    <label class="form-label">O nome da sua foto</label>
                    <input type="text" name="nome" class="form-control" id="" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Coloque seu arquivo</label>
                    <div class="input-group ">
                        <input type="file" class="form-control" name="caminho" accept=".png,.jpg,.jpeg" required>
                        <button class="input-group-text">Upload</button>
                    </div>
                </div>

            </form>
        @else
        <div class="mb-5">
            <h1>Não é possivel modificar</h1>
        </div>
        @endif

        <form method="get" enctype="multipart/form-data" id="pesquisaForm" action="{{ route('foto.pesquisar') }}">
            @csrf
            <div class="input-group mb-5">
                <input type="text" class="form-control" name="nome_pesquisado" placeholder="Busque uma foto pelo nome" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Pesquisar</button>
            </div>
        </form>
        

        @if ($arquivos->isEmpty())
            <div class="d-flex flex-column justify-content-center align-items-center ">

                <div class="">
                    <img src="{{ secure_asset('img/no_image2.jpg') }}" class="img-fluid illustration-img" alt="">
                </div>
                <p>Nenhuma Foto Encontrada</p>
            </div>
        @endif

        <div class="container mt-4">
            <div class="row">
                @foreach ($arquivos as $arquivo)
                    @if ($arquivo->tipo == 1)
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <h3 class="text-center">{{ $arquivo->nome }} </h3>
                            <img class="img-fluid object-fit-xxl-contain mb-4 shadow rounded"
                                src="{{ asset('storage/' . $arquivo->caminho) }}" id="reco" alt="imagem 01">
                            <div class="row d-flex justify-content-between">

                                <div class="col-4">
                                    <form class="form-group" method="post" enctype="multipart/form-data"
                                        action="{{ route('arquivo.visualizar', ['ida' => $arquivo->idArquivo]) }}">
                                        @csrf
                                        @method('get')
                                        <button type="submit" class="btn btn-primary">Visualizar</button>
                                    </form>
                                </div>

                                <div class="col-4">
                                    <form class="form-group" method="post" enctype="multipart/form-data"
                                        action="{{ route('arquivo.download', ['ida' => $arquivo->idArquivo]) }}">
                                        @csrf
                                        @method('get')
                                        <button type="submit" class="btn btn-primary">Download</button>
                                    </form>
                                </div>

                                <div class="col-4 w-auto">
                                    @if ($obra->status == 'Andamento')
                                        <form class="form-group" method="post" enctype="multipart/form-data"
                                            action="{{ route('foto.destroy', ['id' => $obra->idObras, 'ida' => $arquivo->idArquivo]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>





    </div>
@endsection
