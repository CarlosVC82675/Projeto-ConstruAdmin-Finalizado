 {{--modal--}}
  <div class="modal fade" id="visualizarModal" tabindex="-1" aria-labelledby="visualizarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="visualizarModalLabel">Carlos Vinicius</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3"  action="{{ route('usuarios.cadastrar')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Estoque_idEstoque" value="1">
            <input type="hidden" name="password">

            <div class="col-md-4">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="name"   required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Sobrenome</label>
                <input type="text" class="form-control" name="lastName" value" placeholder="" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Atribuição</label>
                <select class="form-select" aria-label="Default select example" name="atribuicao">
                    <option value="" selected></option>
                </select>
              </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="" value="" required>
                </div>
            </div>
                <div class="col-md-4">
                    <label class="form-label">Sexo</label>
                    <select class="form-select" aria-label="Default select example"  name="genero">
                        <option value="" selected></option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">CEP</label>
                    <input type="text" class="form-control" name="cep" placeholder="" value="" required>
                </div>

                  <div class="col-md-6">
                    <label class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="cidade" placeholder=""  value="" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">UF</label>
                    <input type="text" class="form-control" name="estado" placeholder="" value="" required>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Cidadania</label>
                    <input type="text" class="form-control" name="pais" placeholder="" value="" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">CPF</label>
                    <input type="password" class="form-control" name="cpf"  placeholder="" value="" readonly>
                  </div>
                  <div class="col-md-4">
                    <label for="inputZip" class="form-label">Telefone</label>
                    <input type="number" pattern="[0-9]{10}" class="form-control" name="telefone1" placeholder="Digite seu telefone" required>
                  </div>
                  <div class="col-md-4">
                    <label for="inputCity" class="form-label">Celular</label>
                    <input type="number" pattern="[0-9]{10}" class="form-control" name="telefone2" placeholder="Digite seu Celular" required>
                  </div>

                  <div class="col-md-4">
                    <label for="inputCity" class="form-label">Telefone Reserva</label>
                    <input type="number" pattern="[0-9]{10}" class="form-control" name="telefone3" placeholder="Digite seu telefone">
                  </div>

                <div class="col-12 mt-3">
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary custom-btn me-2" data-bs-dismiss="modal">Fechar</button>
                        <a href="" class="btn btn-primary custom-btn me-2">Editar</a>
                        <a href="" class="btn btn-danger custom-btn me-2">Deletar</a>
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
