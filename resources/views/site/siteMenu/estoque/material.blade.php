<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>material</title>
</head>
<body>
    <form action="{{route('registrar.material')}}" method="POST">
        @csrf
        
        <input type="hidden" name="Estoque_idEstoque" value="1">

        <label for="">Nome do material:</label>
        <input type="text" name="nomeM" required>
        
        <label for="">Peso em quilos:</label>
        <input type="number" name="kg" step="any" required>

        <label for="">Metros:</label>
        <input type="number" name="metros" step="any">

        <label for="">quantidade:</label>
        <input type="number" name="quantidade" required>

        <label for="">data Vencimento:</label>
        <input type="date" name="dtVencimento" required> <br>

        <label for="">status:</label>
        <input type="radio" name="Status_2" value="novo">
        <label>Material Novo</label>
        
        <input type="radio" name="Status_2" value="usado">
        <label>Material usado</label> 

        <input type="hidden" name="dtEntrada" value="{{now()}}">

        <button>Enviar</button>
    </form>

    @if ($errors->any())
    {{--se haver algum erro ele vai pecorrer os erros--}}
    @foreach ($errors->all() as $error )
        {{$error}}<br>
    @endforeach
    @endif
    
</body>
</html>