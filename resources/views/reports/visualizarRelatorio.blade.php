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
        <img src="{{ secure_asset('img/capacete.png') }}">
        <div>
            <h3>CONSTRUADMIN <br> SISTEMA DE GERENCIAMENTO DE OBRAS</h3>
            <p>Expedido em: {{ date('d/m/Y') }}</p>
        </div>
    </div>

    <br>
    <br>
    <h2 style=" text-align: center;">Relatório de informações gerais da obra</h2>

    <h2>Introdução:</h2>
    <p class="ptext">
        O presente relatório tem como objetivo documentar as informações da obra em questão
        afim de manter um registro atual do processo de evolução do projeto, esse documento é gerado
        pelo sistema é as informações presentes nele são baseadas no registro de dados atual, portanto á
        autenticidade desse documento é valida somente durante o periodo de um mês a partir da data de geração,
        o uso desse documento deve ser exclusivamente para fins de analise e nao e valido para fins
        juridicos.
    </p>
    <br>
    <h2>Informações Gerais da Obra:</h2>
    <table class="table-smaller-font" style="width: 100%; page-break-inside: avoid;">
        <tbody>
            <tr>
                <td style="width: 50%; text-align: justify;"><strong>Nome:</strong> <br>{{ $obra->nome }}</td>
                <td style="width: 50%; text-align: justify;"><strong>Tipo:</strong> <br>{{ $obra->tipo }}</td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: justify;"><strong>Descrição:</strong> <br>{{ $obra->descricao }}</td>
                <td style="width: 50%; text-align: justify;"><strong>Endereço:</strong>  <br>{{ $obra->logradouro }}, {{ $obra->bairro }}, {{ $obra->cidade }}, {{ $obra->estado }}</td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: justify;"><strong>Proposito:</strong>  <br>{{ $obra->proposito }}</td>
                <td style="width: 50%; text-align: justify;"><strong>Medição:</strong> <br>{{ $obra->tamanho }}m²</td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: justify;"><strong>Data de Inicio:</strong>  <br>{{ $obra->dtInicial }}</td>
                <td style="width: 50%; text-align: justify;"><strong>Prazo:</strong> <br>{{ $obra->dtFinal }}</td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: justify;"><strong>Status:</strong> <br>{{ $obra->status }}</td>
                <td style="width: 50%; text-align: justify;"><strong>Solicitante:</strong> <br>
                    @foreach ($usuariosObra as $usuario)
                    @if ($usuario->hasRole('Cliente'))
                        {{ $usuario->name }} {{ $usuario->lastName }}</li>
                    @endif
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>


<div class="section">
    <h2>Atividades cadastradas na obra:</h2>
    @if ($atividadesDaObra->isNotEmpty())
    @foreach ($cardatividade as $cardatividade)
    <h4>Modulo: {{ $cardatividade->titulo }}</h4>
    <table class="table-smaller-font">
        <thead>
            <tr>
                <th>Modulo</th>
                <th>Atividade</th>
                <th>Início</th>
                <th>Prazo</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($atividadesDaObra as $atividade)
            @if ($atividade->card_atividades_idCard == $cardatividade->idCard)
            <tr>
                <td>{{ $cardatividade->titulo }}</td>
                <td>{{ $atividade->nome }}</td>
                <td>{{ $atividade->dtInicial }}</td>
                <td>{{ $atividade->dtFinal }}</td>
                <td class="status-cell">{{ $atividade->status }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    @endforeach
    @else
    <p>Nenhuma atividade cadastrado na obra.</p>
    @endif
</div>


<div class="section">
    <h2>Usuários Associados a Obra:</h2>
    @if ($usuariosObra->isNotEmpty())
    <ol>
        @foreach($usuariosObra as $usuario)
            <li>{{ $usuario->name }} {{ $usuario->lastName }} -

                @foreach($usuario->roles as $role)
                [{{ $role->name }}]
                @endforeach
            </li>

        @endforeach
    </ol>
    @else
    <p>Nenhum usuário cadastrado na obra.</p>
    @endif
</div>


<div class="section">
    <h2>Conclusão:</h2>
    <p class="ptext">
        Este relatório apresenta uma visão detalhada das informações gerais da obra em questão. Documentando o estado atual, descrição, tipo, tamanho calculado, endereço e propósito da obra, fornece uma visão completa do projeto em andamento.

        Além disso, as atividades cadastradas são apresentadas, organizadas pelos módulos.

        Também é relevante mencionar a relação dos usuários associados à obra, mostrando seus nomes e respectivas funções dentro do sistema.

        Este relatório serve como um registro abrangente do progresso e dos participantes envolvidos no projeto, facilitando a compreensão do estado atual da obra e de seus processos.
    </p>
</div>
</body>
</html>
