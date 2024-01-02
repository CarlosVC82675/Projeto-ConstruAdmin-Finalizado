<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visualizando</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/3117251fc7.js" crossorigin="anonymous"></script>
</head>
<body >
    <div style="display:flex;height:100vh;width:100vw;justify-content:center;align-items:center">
 
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
            @if ($obra->status == 'Andamento')
            <div class="col-4 w-auto">
               
                    <form class="form-group" method="post" enctype="multipart/form-data"
                        action="{{ route('foto.destroy', ['id' => $obra->idObras, 'ida' => $arquivo->idArquivo]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                
            </div>
            @endif
        </div>
    </div>



</div>
</body>
</html>