@extends('siteThauan.layoult_base')
@section('title', 'Editar Atividade')

@section('content')
<div class="row">
    <div class="col s12">
        <form action="{{ route('atualizarAtividade', ['idAtividade' => $atividade->idAtividade]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="nome">Nome da Atividade:</label>
            <input type="text" name="nome" class="validate" value="{{ $atividade->nome }}" required>

            <label for="dtFinal">Data Final da Atividade:</label>
            <input type="date" name="dtFinal" class="validate" value="{{ $atividade->dtFinal }}" required>

            <label for="dtInicial">Data Inicial da Atividade:</label>
            <input type="date" name="dtInicial" class="validate" value="{{ $atividade->dtInicial }}" required>

            <label for="status">Status da Atividade:</label>
            <input type="text" name="status" class="validate" value="{{ $atividade->status }}" required>

            <label for="Obras_idObras">Obra relacionada:</label>
            <input type="text" name="Obras_idObras" class="validate" value="{{ $atividade->Obras_idObras }}" required>

            <label for="descricao">Descrição da Atividade:</label>
            <input type="text" name="descricao" class="validate" value="{{ $atividade->descricao }}" required>

            <label for="etiqueta">Etiqueta da Atividade:</label>
            <input type="file" name="etiqueta[]" required>

            <label for="anexo">Anexo da Atividade:</label>
            <input type="file" name="anexo[]" required>

            <button type="submit">Salvar</button>
        </form>
    </div>
</div>
@endsection
