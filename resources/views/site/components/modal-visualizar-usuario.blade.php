
 {{--modal de visualizar--}}
 <div class="modal fade" id="visualizarModal" tabindex="-1" aria-labelledby="visualizarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="visualizarModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3" id="usuarioForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="Estoque_idEstoque" value="1">
            <input type="hidden" name="password">

            <div class="col-md-4">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="name" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Sobrenome</label>
                <input type="text" class="form-control" name="lastName"  required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Nº Acesso</label>
                <input type="text" class="form-control" name="atribuicao" readonly>
              </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>
                <div class="col-md-4">
                    <label class="form-label">Sexo</label>
                    <input type="text" class="form-control" name="genero" readonly>
                </div>

                <div class="col-md-3">
                    <label class="form-label">CEP</label>
                    <input type="text" class="form-control cep" name="cep" id="cep2" oninput="buscarCEPAtualizado()" required>
                </div>

                  <div class="col-md-6">
                    <label class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="cidade" id="cidade2" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">UF</label>
                    <input type="text" class="form-control" name="estado" id="uf2" required>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Cidadania</label>
                    <input type="text" class="form-control" name="pais" readonly>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">CPF</label>
                    <input type="password" class="form-control" name="cpf" readonly>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Telefone</label>
                    <input type="text"  class="form-control telefoneFixo" name="telefone1" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Celular</label>
                    <input type="text"   class="form-control telefoneMovel" name="telefone2" required>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Telefone Reserva</label>
                    <input type="text"   class="form-control telefoneMovel" name="telefone3">
                  </div>

                <div class="col-12 mt-3">
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary custom-btn me-2" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
 {{--Fim modal de visualizar--}}
