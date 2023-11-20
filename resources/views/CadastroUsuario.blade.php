@extends('layout')
@section('conteudo')


    <h1 class="mb-4">Cadastro de Usuarios</h1>

   <form action="{{ route('cadastrar.usuarios')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="Estoque_idEstoque" value="1">
        <input type="hidden" name="password">

        <div class="mb-3">
            <label class="form-label">Selecione a Atribuição do Usuario:</label>
            <select class="form-select" aria-label="Default select example" name="atribuicao_Usuario_id_Atribuicao">
                @foreach ($atribuicoes as $atribuicao)
                <option value={{$atribuicao->id_atribuicao}}>{{$atribuicao->atribuição}}</option>
                @endforeach
              </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Selecione o supevisor encarregado</label>
            <select class="form-select" aria-label="Default select example" name="Superior_idUsuario">
                <option selected>Nao tenho Supervisor</option>
                @foreach ($supervisores as $supervisor)
                <option value={{$supervisor->idUsuario}}>{{$supervisor->name}}</option>
                @endforeach
              </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input type="text" class="form-control" name="name" placeholder="Digite seu nome" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sobrenome</label>
            <input type="text" class="form-control" name="lastName" placeholder="Digite seu Sobrenome" required>
          </div>
        <p>Genero:</p>
        <div class="mb-3 form-check">
            <input class="form-check-input" type="radio" name="genero" value="Masculino">
            <label class="form-check-label" for="flexRadioDefault1">
              Masculino
            </label>
        </div>
        <div class="mb-3 form-check">
            <input class="form-check-input" type="radio" name="genero" value="Feminino">
            <label class="form-check-label" for="flexRadioDefault1">
              Feminino
            </label>
        </div>
        <div class="mb-3">
            <label class="form-label">Cep</label>
            <input type="text" class="form-control" name="cep" placeholder="Digite seu CEP" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Cpf</label>
            <input type="text" class="form-control" name="cpf" placeholder="Digite seu CPF" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Pais</label>
            <input type="text" class="form-control" name="pais" placeholder="Digite seu Pais de Origem" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Cidade</label>
            <input type="text" class="form-control" name="cidade" placeholder="Digite sua cidade" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Estado</label>
            <input type="text" class="form-control" name="estado" placeholder="Digite seu estado" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Digite seu Email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Telefone 1</label>
            <input type="tel" pattern="[0-9]{10}" class="form-control" name="telefone1" placeholder="Digite seu telefone" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Telefone 2(Opcional)</label>
            <input type="tel" pattern="[0-9]{10}" class="form-control"  name="telefone2" placeholder="Digite seu telefone 2">
          </div>
          <div class="mb-3">
            <label class="form-label">Telefone 3(Opcional)</label>
            <input type="tel" pattern="[0-9]{10}" class="form-control" name="telefone3" placeholder="Digite seu telefone 3">
          </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>

@endsection
