<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <H1>Começe uma obra</H1>
    <div style="display:flex;justify-content:center;width:100%">
    <form style="display:flex; flex-direction:column" method="post" action="{{ route('obra.store') }}">
        @csrf
        <label>nome:</label>
        <input type="text" name="nome" required>
        <label>status:</label>
        <label >começando</label>
        <input type="radio" name="status" value="COMECANDO">
        <label >andamento</label>
        <input type="radio"  name="status" value="ANDAMENTO">
        <label >finalizado</label>
        <input type="radio"  name="status" value="FINALIZADO">
        <label>descrição:</label>
        <input type="text" name="descricao" required>
        <label>tamanho:</label>
        <input type="number" name="tamanho" required>
        <label >Tipo da Obra</label>
        <label >Residencial</label>
        <input type="radio" name="tipo" value="RESIDENCIAL">
        <label >Comercial</label>
        <input type="radio"  name="tipo" value="COMERCIAL">
        <label >Industrial</label>
        <input type="radio"  name="tipo" value="INDUSTRIAL">
        <label >Infraestrutura</label>
        <input type="radio"  name="tipo" value="INFRAESTRUTURA">
        <label >Saneamento</label>
        <input type="radio"  name="tipo" value="SANEAMENTO">
        <label >Restauro</label>
        <input type="radio"  name="tipo" value="RESTAURO">
        <label>Logradouro:</label>
        <input type="text" name="logradouro" required>
        <label>Numero Residencial:</label>
        <input type="number" name="numResidencial" required>
        <label>Bairro:</label>
        <input type="text" name="bairro" required>
        <label>Cidade:</label>
        <input type="text" name="cidade" required>
        <label>Estado:</label>
        <input type="text" name="estado" required>
        <label>Cep:</label>
        <input type="number" name="cep" required>
        <label>Estrutura</label>
        <label >Metalica</label>
        <input type="radio" name="estrutura" value="METALICA">
        <label >Concreto</label>
        <input type="radio"  name="estrutura" value="CONCRETO">
        <label >Madeira</label>
        <input type="radio"  name="estrutura" value="MADEIRA">
        <label>Proposito</label>
        <input type="text" name="proposito" required>
        <label >Data Estimada de Termino</label>
        <input type="date" name="dtFinal" value="0000-00-00" min="2020-01-01" max="2024-12-31" />
        <label >Data de inicio</label>
        <input type="date" name="dtInicial" value="0000-00-00" min="2020-01-01" max="2024-12-31" />
       


        <button style="max-width: 30%;margin-top:10px" type="submit">Salvar</button>
    </form>
</div>
</body>
</html>