<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adicionar quantidade de materiais</title>
</head>
<body>
    <h2>Aumentar quantidade do material {{$material->nomeM}}</h2>

    <form action="{{route('adicionar.material', ['id' => $material->idMateriais])}}" method="POST">
        @csrf 
        <label for="">Insira a quantidade de materiais que deseja adicionar:</label>
        <input type="number" name="quantidade">

        <input type="hidden" name="dtEntrada" value="{{now()}}">
        <button type="submit">Enviar</button>
    </form> 
    @if ($errors->any())
    {{--se haver algum erro ele vai pecorrer os erros--}}
    @foreach ($errors->all() as $error )
        {{$error}}<br>
    @endforeach
    @endif
</body>
</html>