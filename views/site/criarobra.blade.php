<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    
    <H1>Começe uma obra</H1>
    @if($errors->any())
        @foreach ($errors->all() as $error)
        {{$error}} <br>
        @endforeach
    @endif
    <div style="display:flex;justify-content:center;width:100%">    
    <form style="display:flex; flex-direction:column" method="post" action="{{ route('obra.store') }}">
        @csrf
        <label>nome:</label>
        <input type="text" name="nome" required>
        <input type="hidden" name="status" value="Andamento">
        <label>descrição:</label>
        <input type="text" name="descricao" required>
        <label>tamanho da obra (em metros):</label>
        <input type="text" name="tamanho" required>
        <label >Tipo da Obra</label>
        <label >Residencial</label>
        <input type="radio" name="tipo" value="Residencial" required>
        <label >Comercial</label>
        <input type="radio"  name="tipo" value="Comercial" required>
        <label >Industrial</label>
        <input type="radio"  name="tipo" value="Industrial" required>
        <label >Infraestrutura</label>
        <input type="radio"  name="tipo" value="Infraestrutura" required>
        <label >Saneamento</label>
        <input type="radio"  name="tipo" value="Saneamento" required>
        <label >Restauro</label>
        <input type="radio"  name="tipo" value="Restauro" required>
        <label>Logradouro:</label>
        <input type="text" name="logradouro" required>
        <label>Numero Residencial:</label>
        <input type="text" name="numResidencial" required>
        <label>Bairro:</label>
        <input type="text" name="bairro" required>
        <label>Cidade:</label>
        <input type="text" name="cidade" required>
        <label>Estado:</label>
        <input type="text" name="estado" required>
        <label>Cep:</label>
        <input type="text" name="cep" required>
        <label>Estrutura</label>
        <label >Metalica</label>
        <input type="radio" name="estrutura" value="Metálica" required>
        <label >Concreto</label>
        <input type="radio"  name="estrutura" value="Concreto" required>
        <label >Madeira</label>
        <input type="radio"  name="estrutura" value="Madeira" required>
        <label>Proposito</label>
        <input type="text" name="proposito" required>
        <label >Data de inicio</label>
        <input type="date" name="dtInicial" value="0000-00-00" min="2020-01-01" max="2024-12-31" required />
        <label >Data Estimada de Termino (Opcional)</label>
        <input type="date" name="dtFinal" value="0000-00-00" min="2020-01-01" max="2024-12-31" />
        
       


        <button style="max-width: 30%;margin-top:10px" type="submit">Salvar</button>
    </form>
</div>
</body>
</html>