@extends('site.siteMenu.layoutFora')
@section('conteudo')


<main class="content px-3 py-2">
   {{--Container--}}
    <div class="container-fluid">

        <div class="mb-4 mt-4">
            <h4>Gerenciamento de Usuários</h4>
        </div>

      {{--Card de Usuarios--}}
        <div class="row">
            <div class="col-10 col-md-6 d-flex d-none d-md-block">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body p-0 d-flex flex-fill">
                        <div class="row g-0 w-100">
                            <div class="col-8">
                                <div class="p-3 m-1">
                                    <h4>Bem vindo</h4>
                                    <p class="mb-0">Essa sessão é exclusivamente feita para fazer o gerenciamento de usuários. Se tiver dúvidas, consulte o Manual: <span>"Como gerenciar meus usuários"</span> </p>
                                </div>
                            </div>
                            <div class="col-4 align-self-end text-end d-none d-md-block">
                                <img src="{{secure_asset("img/gerenciarUsuarios.png")}}" class="img-fluid illustration-img" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--aqui--}}
        </div>
      {{--Fim do Card de Usuarios--}}

      {{--Tabela de Funcionarios--}}
        <div class="card border=0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mt-2">Lista de Funcionários</h5>
                <div class="dropdown text-end">

                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Opções
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cadastroModal">Cadastrar</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="dropdown-header">Filtrar:</span></li>
                        <li><a href="#" class="dropdown-item">Ordem alfabética</a></li>
                        <li><a href="#" class="dropdown-item">Nº Acesso</a></li>
                        <li><a href="#" class="dropdown-item">Gênero</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="#" class="dropdown-item">Consultar</a></li>
                    </ul>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Perfil</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Sobrenome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Gênero</th>
                                <th scope="col">Nº Acesso</th>
                                <th scope="col">Relacionado</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                @if (!$usuario->hasRole('Cliente'))
                                <th scope="row">{{$usuario->idUsuario}}</th>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->lastName}}</td>
                                <td>{{ $usuario->telefones()->first()->telefone}}</td>
                                <td>{{$usuario->genero}}</td>
                                <td>{{$usuario->getRoleNames()->first()}}</td>
                                <td>
                                    {{ optional($usuario->obras()->first())->nome ?? 'Livre' }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-primary btn-sm me-2" onclick="exibirDetalhesUsuario({{ json_encode($usuario)}}, {{ $usuario->telefones }} )">Visualizar</a>
                                        <form action="{{ route('usuarios.deletar', ['id' => $usuario->idUsuario]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary btn-sm me-2" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      {{--Fim da Tabela de Funcionarios--}}

      {{--Tabela de Clientes--}}
        <div class="card border=0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mt-2">Lista de Clientes</h5>
                <div class="dropdown text-end">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Opções
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><span class="dropdown-header">Filtrar:</span></li>
                        <li><a href="#" class="dropdown-item">Ordem alfabética</a></li>
                        <li><a href="#" class="dropdown-item">Gênero</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="#" class="dropdown-item">Consultar</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Perfil</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Sobrenome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Gênero</th>
                                <th scope="col">Relacionado</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                               @if ($usuario->hasRole('Cliente'))
                                <th scope="row">{{$usuario->idUsuario}}</th>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->lastName}}</td>
                                <td>{{ $usuario->telefones()->first()->telefone}}</td>
                                <td>{{$usuario->genero}}</td>
                                <td>
                                    {{ optional($usuario->obras()->first())->nome ?? 'Nenhuma' }}
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-primary btn-sm me-2" onclick="exibirDetalhesUsuario({{ json_encode($usuario)}},{{ $usuario->telefones }} )">Visualizar</a>
                                        <form action="{{ route('usuarios.deletar', ['id' => $usuario->idUsuario]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary btn-sm me-2" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      {{--Fim da Tabela de Clientes--}}


    </div>
   {{--Fim do Container--}}
   </main>


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
                <input type="text" class="form-control" name="name" required>
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
                    <input type="text" class="form-control" name="cep" required>
                </div>

                  <div class="col-md-6">
                    <label class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="cidade" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">UF</label>
                    <input type="text" class="form-control" name="estado" readonly>
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
                    <input type="text"  class="form-control" name="telefone1" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Celular</label>
                    <input type="text"   class="form-control" name="telefone2" required>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Telefone Reserva</label>
                    <input type="text"   class="form-control" name="telefone3">
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

 {{--modal de cadastro--}}
   <x-modal-cadastro-usuario />
 {{--Fim modal de cadastro--}}

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


@endsection

