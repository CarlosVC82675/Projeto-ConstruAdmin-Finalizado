<!DOCTYPE html>
<html>
<head>
    <title>Relatório</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin-left: 1.0cm;
            margin-right: 0.5cm;
        }
        h1, h2, h3 {
            font-size: 13pt;
            font-weight: bold;
        }
        h2 {
            font-size: 14pt;
        }
        p {
            max-width: 100%; /* Ajuste o valor conforme necessário */
            word-wrap: break-word;
        }
        li{
            max-width: 100%; /* Ajuste o valor conforme necessário */
            word-wrap: break-word;
        }
        .ptext {
            text-align: justify;
            text-indent: 36pt;
        }
        img {
            width: 80px; /* Ajuste o tamanho conforme necessário */
            position: absolute;
            left: 40; /* Posicionamento no canto esquerdo */

        }
        .header {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            margin-bottom: 25px;
        }
        .table-smaller-font th,
        .table-smaller-font td
        {
            font-size: 10pt;
            max-width: 150px;
            word-break: break-word;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td {
            background-color: #fff;
        }
        p, li {
        max-width: 100%;
        overflow-wrap: normal;
        word-break: normal;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #ddd;
        }
        .status-cell {
            text-transform: capitalize;
        }
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
            font-size: 10pt;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <div>
            <h3>CONSTRUADMIN <br> SISTEMA DE GERENCIAMENTO DE OBRAS</h3>
            <p>Expedido em: {{ date('d/m/Y') }}</p>
        </div>
    </div>

    <br>
    <br>
    <h2 style=" text-align: center;">Relatório de informações Gerais do sistema</h2>

    <h2>Introdução:</h2>
    <p class="ptext">
        O presente relatório tem como objetivo documentar as informações Gerais em questão
        afim de manter um registro atual dos dados do sistema, esse documento é gerado
        pelo sistema é as informações presentes nele são baseadas no registro de dados atual, portanto á
        autenticidade desse documento é valida somente durante o periodo de um mês a partir da data de geração,
        o uso desse documento deve ser exclusivamente para fins de analise e nao e valido para fins
        juridicos.
    </p>

 <!-- Seção de informações das Obras -->
<div class="section">
    <h2>Informações das Obras:</h2>
    @if ($obras->isNotEmpty())
    @foreach($obras as $obra)
    <table class="table-smaller-font" style="width: 100%; page-break-inside: avoid;">
        <tbody>
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold; font-size: 16px; background-color: rgb(239, 239, 239);">{{ $obra->nome }}</td>

            </tr>
            <tr>
                <td style="width: 50%; text-align: justify;"><strong>Tipo:</strong> <br>{{ $obra->tipo }}</td>
                <td style="width: 50%; text-align: justify;"><strong>Status:</strong> <br>{{ $obra->status }}</td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: justify;"><strong>Descrição:</strong> <br>{{ $obra->descricao }}</td>
                <td style="width: 50%; text-align: justify;"><strong>Endereço:</strong>  <br>{{ $obra->logradouro }}, {{ $obra->bairro }}, {{ $obra->cidade }}, {{ $obra->estado }}</td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: justify;"><strong>Data de Inicio:</strong>  <br>{{ $obra->dtInicial }}</td>
                <td style="width: 50%; text-align: justify;"><strong>Prazo:</strong> <br>{{ $obra->dtFinal }}</td>
            </tr>
        </tbody>
    </table>
    @endforeach
    @else
    <p>Nenhuma obra cadastrado no sistema.</p>
    @endif
</div>

<!-- Seção de informações dos Usuários -->
<div class="section">
    <h2>Usuários cadastrados no sistema:</h2>
    @if ($usuarioscadastrados->isNotEmpty())
    <table class="table-smaller-font">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Função</th>
                <th>Obras relacionadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarioscadastrados as $usuario)
            <tr>
                <td>{{ $usuario->name }} {{$usuario->lastName}}</td>
                <td>
                    @foreach($usuario->roles as $role)
                    {{ $role->name }}
                    @endforeach
                </td>
                <td>
                    @php
                        $obras = $usuario->obras()->get();
                    @endphp

                    @if ($obras->isNotEmpty())
                        @foreach ($obras as $index => $obra)
                            {{ $obra->nome }}
                            @if ($index !== $obras->count() - 1)
                                , <!-- Adicione um separador se não for o último relacionamento -->
                            @endif
                        @endforeach
                    @else
                        Nenhuma
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nenhum usuário cadastrado no sistema.</p>
    @endif
</div>

<!-- Seção de informações dos Materiais em Estoque -->
<div class="section">
    <h2>Informações dos Materiais em Estoque:</h2>
    @if ($materiasEstoque->isNotEmpty())
    <table class="table-smaller-font">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Ultima Entrada</th>
                <th>Ultima Retirada</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiasEstoque as $material)
            <tr>
                <td>{{ $material->nomeM }}</td>
                <td>{{ $material->quantidade }}</td>
                <td>{{ $material->dtEntrada }}</td>
                <td>{{ $material->dtSaida }}</td>
                <td>{{ $material->Status_2 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nenhum Material cadastrado no sistema.</p>
    @endif
</div>

<div class="section">
    <h2>Conclusão:</h2>
    <p class="ptext">
        Este relatório de informações gerais da obra oferece um panorama abrangente das atividades em curso, dos usuários envolvidos e dos materiais disponíveis no estoque relacionados às obras cadastradas no sistema.
        As informações detalhadas sobre cada obra, incluindo nome, tipo, descrição, propósito e endereço, permitem uma visão clara dos detalhes de cada projeto em andamento.
        Além disso, a seção sobre informações dos usuários fornece detalhes dos usuários cadastrados no sistema.
        Por fim, a tabela de informações dos materiais em estoque fornece uma visão do estoque disponível para uso nas obras.
    </p>
</div>

<a href="{{ asset('storage/temp/relatorio_Geral.pdf') }}" download="relatorio_Geral.pdf">Baixar Relatório</a>

</body>
</html>
