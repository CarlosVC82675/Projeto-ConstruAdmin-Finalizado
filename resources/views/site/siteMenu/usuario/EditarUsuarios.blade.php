@extends('site.siteMenu.usuario.layout')
@section('conteudo')


    <h1 class="mb-4">Atualizar Usuarios</h1>

   <form action="{{ route('atualizar.usuario', ['id' => $usuario->idUsuario])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="Estoque_idEstoque" value="1">
        <input type="hidden" name="password">
        <input type="hidden" name="genero" value="Feminino">

        <div class="mb-3">
            <label class="form-label">Selecione a Atribuição do Usuario:</label>
            <select class="form-select" aria-label="Default select example" name="atribuicao_Usuario_id_Atribuicao" readonly>
                <option value="{{$usuario->atribuicao_Usuario_id_Atribuicao}}" selected>{{$usuario->atribuição->atribuição}}</option>
              </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Selecione o supevisor encarregado</label>
            <select class="form-select" aria-label="Default select example" name="Superior_idUsuario" disabled>
                <option value="{{$usuario->Superior_idUsuario}}" selected>{{$usuario->Superior_idUsuario}}</option>
              </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input type="text" class="form-control" name="name" placeholder="{{$usuario->name}}" value="{{$usuario->name}}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sobrenome</label>
            <input type="text" class="form-control" name="lastName" placeholder="{{$usuario->lastName}}" value="{{$usuario->lastName}}" required>
          </div>
        <div class="mb-3">
            <label class="form-label">Cep</label>
            <input type="text" class="form-control" name="cep" placeholder="{{$usuario->cep}}" value="{{$usuario->cep}}"  required>
          </div>
          <div class="mb-3">
            <label class="form-label">Cpf</label>
            <input type="password" class="form-control" name="cpf" placeholder="{{$usuario->cpf}}" value="{{$usuario->cpf}}" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Pais</label>
            <input type="text" class="form-control" name="pais" placeholder="{{$usuario->pais}}" value="{{$usuario->pais}}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Cidade</label>
            <input type="text" class="form-control" name="cidade" placeholder="{{$usuario->cidade}}"  value="{{$usuario->cidade}}"  required>
          </div>
          <div class="mb-3">
            <label class="form-label">Estado</label>
            <input type="text" class="form-control" name="estado" placeholder="{{$usuario->estado}}" value="{{$usuario->estado}}"  required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="{{$usuario->email}}" value="{{$usuario->email}}"  required>
          </div>
          <div class="mb-3">
            <label class="form-label">Telefone 1</label>
            <input type="number"  class="form-control" name="telefone1" placeholder="" value="" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Telefone 2(Opcional)</label>
            <input type="number"  class="form-control"  name="telefone2" placeholder="">
          </div>
          <div class="mb-3">
            <label class="form-label">Telefone 3(Opcional)</label>
            <input type="number" class="form-control" name="telefone3" placeholder="">
          </div>

        <button type="submit" class="btn btn-primary">Editar</button>
      </form>

      <form action="{{ route('deletar.usuarios', ['id' => $usuario->idUsuario]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-primary" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
    </form>

@endsection
