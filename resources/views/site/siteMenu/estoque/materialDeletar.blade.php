<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deletar material</title>
</head>
<body>
    <h1>Deletar {{$material->nomeM}}</h1>
    <form action="{{route('deletar.material', ['id' => $material->idMateriais])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
    </form>
</body>
</html>