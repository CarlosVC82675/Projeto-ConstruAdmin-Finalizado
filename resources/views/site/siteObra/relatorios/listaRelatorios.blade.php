@extends('site.siteObra.layoutdentro')
@section('title','Relatorios')
@section('conteudo')

<style>
.btn-download {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    text-align: center;
}
table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    td {
        width: 50%;
    }
</style>


<div style="padding: 25px">

    <h1>Lista de Relatórios</h1>
    @if($errors->any())
    @foreach ($errors->all() as $error)
    {{$error}} <br>
    @endforeach
    @endif

    <table>
        <thead>
            <tr>
                <th>Relatórios sobre a Obra</th>
                <th>Relatórios de Materiais</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border-right: none;">
                    <p>Relatório de informações Gerais da Obra</p>
                    <a href="{{ route('relatorio.obra', ['id' => $obra->idObras]) }}" class="btn-download">Baixar relatorio.PDF</a>
                </td>
                <td>
                    <p>Relatório de Materiais usados</p>
                    <a href="{{ route('relatorio.materiais', ['id' => $obra->idObras]) }}" class="btn-download">Baixar relatorio.PDF</a>
                </td>
            </tr>
        </tbody>
    </table>


@endsection
