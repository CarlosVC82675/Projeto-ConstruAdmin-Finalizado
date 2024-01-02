<!DOCTYPE html>
<html>
<head>
    <title>Relatório</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin-left: 1.5cm;
            margin-right: 0.8cm;
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
            margin-bottom: 20px;
        }
        .table-smaller-font th,
        .table-smaller-font td
        {
            font-size: 10pt; /* Altere o tamanho conforme desejado */
            max-width: 150px; /* Ajuste o valor conforme necessário */
            word-break: break-word; /* Outros estilos que desejar */

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
    <h2 style=" text-align: center;">Relatório de Materias da obra</h2>

    <h2>Introdução:</h2>
    <p class="ptext">
        O presente relatório tem como objetivo documentar as informações da obra em questão
        afim de manter um registro atual do processo de evolução do projeto, esse documento é gerado
        pelo sistema é as informações presentes nele são baseadas no registro de dados atual, portanto á
        autenticidade desse documento é valida somente durante o periodo de um mês a partir da data de geração,
        o uso desse documento deve ser exclusivamente para fins de analise e nao e valido para fins
        juridicos.
    </p>

    <div class="section">
        <h2>Materiais da Obra:</h2>
        @if ($materiaisDaObra->isNotEmpty())
        <table class="table-smaller-font">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiaisDaObra as $material)
                <tr>
                    <td>{{ $material->nomeM }}</td>
                    <td>{{ $material->pivot->quantidade }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Nenhum Material cadastrado na obra.</p>
        @endif
    </div>


<div class="section">
    <h2>Comparativo entre Materiais da Obra e Estoque:</h2>
    @if ($materiaisDaObra->isNotEmpty())
    <table class="table-smaller-font">
        <thead>
            <tr>
                <th>Material</th>
                <th>Quantidade na Obra</th>
                <th>Quantidade em Estoque</th>
                <th>Ultima Entrada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiaisDaObra as $materialObra)
                @php
                    $materialEstoque = $materiasEstoque->firstWhere('nomeM', $materialObra->nomeM);
                    $quantidadeEstoque = $materialEstoque ? $materialEstoque->quantidade : 0;
                @endphp
                <tr>
                    <td>{{ $materialObra->nomeM }}</td>
                    <td>{{ $materialObra->pivot->quantidade }}</td>
                    <td>{{ $quantidadeEstoque }}</td>
                    <td>{{ $materialObra->dtEntrada }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nenhum Material cadastrado na obra.</p>
    @endif
</div>

<div class="section">
    <h2>Conclusão:</h2>
    <p class="ptext">
        O presente relatório detalhou os materiais utilizados na obra, fornecendo uma visão abrangente das quantidades de cada item presente no local.
        Além disso, comparou-se a quantidade disponível na obra com o estoque atual, permitindo uma análise da disponibilidade e necessidade de reposição de materiais.
        Esse comparativo entre os materiais presentes na obra e aqueles disponíveis em estoque permite uma melhor gestão dos recursos, destacando a importância do controle e reposição dos itens conforme necessário.
        Esse relatório serve como um guia para a administração de recursos, facilitando a identificação de necessidades de reabastecimento e o monitoramento do consumo dos materiais ao longo do projeto.
    </p>
</div>

<a href="{{ asset('storage/temp/relatorio_Materiais.pdf') }}" download="relatorio_Materiais.pdf">Baixar Relatório</a>

</body>
</html>
