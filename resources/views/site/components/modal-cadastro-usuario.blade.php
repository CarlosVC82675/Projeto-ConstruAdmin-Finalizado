  {{--modal--}}
  <div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cadastroModalLabel">CADASTRO DE USUÁRIOS</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3"  action="{{route('usuarios.cadastrar')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Estoque_idEstoque" value="1">
            <input type="hidden" name="password">

            <div class="col-md-4">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="name" placeholder="Digite seu nome" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Sobrenome</label>
                <input type="text" class="form-control" name="lastName" placeholder="Digite seu Sobrenome" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Nº Acesso</label>
                <select class="form-select" aria-label="Default select example" name="atribuicao">
                <option value="2">Supervisor</option>
                <option value="3">Apontador</option>
                <option value="4">Engenheiro</option>
                <option value="6">Comum</option>
                </select>
              </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Digite seu Email" required>
                </div>
            </div>
                <div class="col-md-4">
                    <label class="form-label">Sexo</label>
                    <select class="form-select" aria-label="Default select example"  name="genero">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">CEP</label>
                    <input type="text" class="form-control" name="cep" placeholder="Digite seu CEP" required>
                </div>

                  <div class="col-md-6">
                    <label class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="cidade" placeholder="Digite sua cidade" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">UF</label>
                    <input type="text" class="form-control" name="estado" placeholder="Digite seu estado" required>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Cidadania</label>
                    <input type="text" class="form-control" name="pais" placeholder="Digite seu Pais de Origem" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">CPF</label>
                    <input type="text" class="form-control" name="cpf" placeholder="Digite seu CPF" required>
                  </div>
                  <div class="col-md-4">
                    <label  class="form-label">Telefone</label>
                    <input type="text"  class="form-control" name="telefone1" placeholder="Digite seu telefone" required>
                  </div>
                  <div class="col-md-4">
                    <label  class="form-label">Celular</label>
                    <input type="text"  class="form-control" name="telefone2" placeholder="Digite seu Celular" required>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Telefone Reserva</label>
                    <input type="text"  class="form-control" name="telefone3" placeholder="Digite seu telefone">
                  </div>

                <div class="col-12 mt-3">
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary custom-btn me-2" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary custom-btn me-2">Enviar</button>

                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
