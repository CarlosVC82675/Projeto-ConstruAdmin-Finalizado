<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Remover quantidade material</title>
</head>
<body>
    <h2>Remova a quantidade do material {{$material->nomeM}}</h2>
    <p>Essa é a quantidade atual desse material {{$material->quantidade}}</p>

    <form action="{{route('remover.material', ['id' => $material->idMateriais])}}" method="POST">
        @csrf
        <label for="">Insira a quantidade que deseja remover desse material:</label>
        <input type="number" name="quantidade">

        <input type="hidden" name="dtSaida" value="{{now()}}">
        <button>Enviar</button>
    </form>

    @if (session('erro'))
    <div class="alert alert-danger">
        {{ session('erro') }}
    </div>
@endif

</body>
</html>