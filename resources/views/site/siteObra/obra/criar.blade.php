@extends('site.siteMenu.layoutFora')
@section('title', 'Criando Obra')

@section('conteudo')



    <div style="padding: 10px">
        <H1>Comece uma obra</H1>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        @endif
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadastroModalLabel">Erro</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('site.criarobra') }}" method="get" enctype="multipart/form-data">
                            @csrf


                            <h2>Houve algum erro ao cadastrar obra</h2>


                            <button type="submit" class="btn btn-primary mt-3">Volte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="finalizar" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadastroModalLabel">Finalizar</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('site.index') }}" method="get" enctype="multipart/form-data">
                            @csrf


                            <h2>Obra concluida com sucesso</h2>


                            <button type="submit" class="btn btn-primary mt-3">Finalizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="associando" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadastroModalLabel">Associando Funcionários</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('funcionario.associar') }}" id="formAssociando" method="POST"
                            enctype="multipart/form-data">
                            @csrf


                            <h2>Selecione os funcionários para essa obra:</h2>
                            <select name="usuarios[]" multiple class="form-select" multiple
                                aria-label="multiple select example">>
                                @foreach ($supervisores as $sup)
                                    <option value="{{ $sup->idUsuario }}">Supervisor: {{ $sup->name }} </option>
                                @endforeach
                                @foreach ($apontadores as $apo)
                                    <option value="{{ $apo->idUsuario }}">Apontador: {{ $apo->name }} </option>
                                @endforeach
                                @foreach ($usuarios as $usuario)
                                    @if ($usuario->hasRole('Engenheiro'))
                                        <option value="{{ $usuario->idUsuario }}">Engenheiro: {{ $usuario->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        {{-- modal Cliente  --}}
        <div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadastroModalLabel">CADASTRO DO CLIENTE</h5>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="cliente" action="{{ route('usuarios.cadastrar') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="Estoque_idEstoque" value="1">
                            <input type="hidden" name="password">
                            <input type="hidden" name="atribuicao" value="5">

                            <div class="col-md-4">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" placeholder="Digite seu nome"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" name="lastName"
                                    placeholder="Digite seu Sobrenome" required>
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Digite seu Email"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sexo</label>
                                <select class="form-select" aria-label="Default select example" name="genero">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">CEP</label>
                                <input type="text" class="form-control" name="cep" placeholder="Digite seu CEP"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="cidade"
                                    placeholder="Digite sua cidade" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">UF</label>
                                <input type="text" class="form-control" name="estado"
                                    placeholder="Digite seu estado" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Cidadania</label>
                                <input type="text" class="form-control" name="pais"
                                    placeholder="Digite seu Pais de Origem" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">CPF</label>
                                <input type="text" class="form-control" name="cpf" placeholder="Digite seu CPF"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Telefone</label>
                                <input type="number" pattern="[0-9]{10}" class="form-control" name="telefone1"
                                    placeholder="Digite seu telefone" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Celular</label>
                                <input type="number" pattern="[0-9]{10}" class="form-control" name="telefone2"
                                    placeholder="Digite seu Celular" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Telefone Reserva</label>
                                <input type="number" pattern="[0-9]{10}" class="form-control" name="telefone3"
                                    placeholder="Digite seu telefone">
                            </div>

                            <div class="col-12 mt-3">
                                <hr>
                                <div class="d-flex justify-content-end">

                                    <button type="submit" class="btn btn-primary custom-btn me-2">Enviar</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        {{-- Formulario Obra --}}

        <form id="formCadastro" class="row g-3" method="post" action="{{ route('obra.store') }}">
            @csrf
            <input type="hidden" name="status" value="Andamento">

            <div class="col-md-6">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" required placeholder="Nome">
                <label class="form-label">Tamanho</label>
                <input type="text" class="form-control" name="tamanho" required placeholder="Tamanho da sua obra">
            </div>
            <div class="col-md-6">
                <label>Descrição</label>
                <div class="form-floating">
                    <textarea class="form-control" name="descricao" required style="height: 116px"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Tipo da obra</label>
                    <select class="form-select" aria-label="Default select example" name="tipo">
                        <option value="Residencial">Residencial</option>
                        <option value="Comercial">Comercial</option>
                        <option value="Industrial">Industrial</option>
                        <option value="Infraestrutura">Infraestrutura</option>
                        <option value="Saneamento">Saneamento</option>
                        <option value="Restauro">Restauro</option>
                    </select>

                    <label class="form-label">Estrutura da obra</label>
                    <select class="form-select" aria-label="Default select example" name="estrutura">
                        <option value="Metálica">Metálica</option>
                        <option value="Concreto">Concreto</option>
                        <option value="Madeira">Madeira</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <label>Proposito</label>
                <div class="form-floating">
                    <textarea class="form-control" name="proposito" required style="height: 116px"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Logradouro</label>
                <input type="text" class="form-control" name="logradouro" required placeholder="Logradouro">
            </div>
            <div class="col-md-4">
                <label class="form-label">Bairro</label>
                <input type="text" class="form-control" name="bairro" required placeholder="Bairro">
            </div>
            <div class="col-md-2">
                <label class="form-label">Numero Residencial</label>
                <input type="text" class="form-control" name="numResidencial" required
                    placeholder="Numero Residencial">
            </div>



            <div class="col-md-6">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control" name="cidade" placeholder="Cidade" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Estado</label>
                <input type="text" class="form-control" name="estado" placeholder="Estado" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control" name="cep" placeholder="EX: 40750-226" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Data de inicio</label>
                <input type="date" class="form-control" name="dtInicial" min="2020-01-01" max="2025-12-31"
                    required />
            </div>
            <div class="col-md-6">
                <label class="form-label">Data de terminio</label>
                <input type="date" class="form-control" name="dtFinal" min="2020-01-01" max="2025-12-31" required />
            </div>


            <div class="col-12">
                <button type="submit" id="botao" class="btn btn-primary">Cadastrar </button>
            </div>

        </form>

        <script>
            $(document).ready(function() {


                $("#formCadastro").on("submit", function(event) {
                    event.preventDefault();
                    $('#cadastroModal').modal('show');
                    $('#cadastroModal').on('hide.bs.modal', function(event) {
                        return false; // previne o fechamento do modal
                    });
                });

                $("#cliente").on("submit", function(event) {
                    event.preventDefault();
                    
                    $('#cadastroModal').off('hide.bs.modal');
                    $("#cadastroModal").modal('hide');
                    $('#associando').modal('show');
                    $('#associando').on('hide.bs.modal', function(event) {
                        return false; // previne o fechamento do modal
                    });
                });

                $("#associando").on("submit", function(event) {
                    event.preventDefault();


                    // Use Promise.all para garantir que ambas as chamadas AJAX sejam concluídas antes de prosseguir
                    Promise.all([

                        $.ajax({
                            url: "/obra",
                            method: "POST",
                            data: $("#formCadastro").serialize()
                        }).fail(function(xhr, status, error) {
                            // Exibir a mensagem de erro no navegador
                            alert('Erro de cadastro da obra');
                        }),
                        $.ajax({
                            url: "/usuario/store",
                            method: "POST",
                            data: $("#cliente").serialize()
                        }).fail(function(xhr, status, error) {
                            // Exibir a mensagem de erro no navegador
                            alert('Erro de cadastro no usuario');
                        })



                    ]).then(function() {
                        $.ajax({
                            url: "/obra/associar",
                            method: "POST",
                            data: $("#formAssociando").serialize()
                        });
                        $('#associando').off('hide.bs.modal');
                        $("#associando").modal('hide');
                        $("#finalizar").modal('show');
                        $('#finalizar').on('hide.bs.modal', function(event) {
                            return false; // previne o fechamento do modal
                        });

                    }).catch(function(jqXHR, textStatus) {
                        // Se ocorreu algum erro na chamada AJAX, exiba o modal de erro
                        if (jqXHR.status !== 200) {
                            $('#associando').off('hide.bs.modal');
                            $("#associando").modal('hide');
                            $('#errorModal').modal('show');
                            $('#errorModal').on('hide.bs.modal', function(event) {
                                return false; // previne o fechamento do modal
                            });
                        };

                    });
                });
            });
        </script>



    @endsection
