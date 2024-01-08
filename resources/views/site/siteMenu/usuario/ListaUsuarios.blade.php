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
            <div id="usuariocard" class="col-10 col-md-6 d-flex d-none d-md-block">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body p-0 d-flex flex-fill">
                        <div class="row g-0 w-100">
                            <div class="col-8">
                                <div class="p-3 m-1">
                                    <h4>Bem vindo</h4>
                                    <p class="mb-0 text-md-start" style="text-align: justify;">Essa sessão é exclusivamente feita para gerenciar usuários. Se tiver dúvidas, consulte o video abaixo:<br> <a href="#" target="_blank"><span>"Como gerenciar meus usuários"</span> </a></p>
                                </div>
                            </div>
                            <div class="col-4 align-self-end text-end d-none d-md-block">
                                <img src="{{secure_asset("img/gerenciarUsuarios.png")}}" class="img-fluid illustration-img" alt="">
                            </div>
                        </div>
                    </div>
                </div>
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
                        <li><a href="#" class="dropdown-item filtro-alfabetico">Ordem alfabética</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="#" id="btnBuscar" class="dropdown-item">Consultar</a></li>
                    </ul>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelaFuncionarios" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Perfil</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Sobrenome</th>
                                <th scope="col">Contato</th>
                                <th scope="col">Gênero</th>
                                <th scope="col">Nº Acesso</th>
                                <th scope="col">Alocado</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                @if (!$usuario->hasRole('Cliente'))
                                <th scope="row">
                                    @if($usuario->genero == 'MASCULINO')
                                    <img src="{{ secure_asset('img/avatar.png') }}" class="rounded-circle me-3" width="40" height="40" alt="Foto do Usuário">
                                    @else
                                    <img src="{{ secure_asset('img/avatarFeminine.png') }}" class="rounded-circle me-3" width="40" height="40" alt="Foto do Usuário">
                                    @endif
                                </th>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->lastName}}</td>
                                <td>
                                    @if($usuario->telefones()->exists())
                                        {{ $usuario->telefones()->first()->telefone }}
                                    @else
                                        Nenhum telefone registrado
                                    @endif
                                </td>
                                <td>{{$usuario->genero}}</td>
                                <td>{{$usuario->getRoleNames()->first()}}</td>
                                <td>
                                    @php
                                        $obras = $usuario->obras()->get();
                                    @endphp

                                    @if ($obras->isNotEmpty())
                                        @foreach ($obras as $index => $obra)
                                            {{ $obra->nome }}
                                            @if ($index !== $obras->count() - 1)
                                                , <!-- Adicione um separador se não for o último relacionamento -->
                                            @endif
                                        @endforeach
                                    @else
                                        Nenhuma
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-primary btn-sm me-2" onclick="exibirDetalhesUsuario({{ json_encode($usuario)}}, {{ $usuario->telefones }} )">Visualizar</a>
                                        <form action="{{ route('usuarios.deletar', ['id' => $usuario->idUsuario]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm me-2 " onclick="return confirm('Tem certeza que deseja deletar esse Usuario? o cadastro dele sera excluido tanto do sistema quanto das obras do qual ele faz parte.')">Deletar</button>
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
                        <li><a href="#" class="dropdown-item filtro-alfabetico2">Ordem alfabética</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelaclientes" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Perfil</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Sobrenome</th>
                                <th scope="col">Contato</th>
                                <th scope="col">Gênero</th>
                                <th scope="col">Relacionado</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                               @if ($usuario->hasRole('Cliente'))
                                <th scope="row">
                                    @if($usuario->genero == 'MASCULINO')
                                    <img src="{{ secure_asset('img/avatar.png') }}" class="rounded-circle me-3" width="40" height="40" alt="Foto do Usuário">
                                    @else
                                    <img src="{{ secure_asset('img/avatarFeminine.png') }}" class="rounded-circle me-3" width="40" height="40" alt="Foto do Usuário">
                                    @endif
                                </th>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->lastName}}</td>
                                <td>
                                    @if($usuario->telefones()->exists())
                                        {{ $usuario->telefones()->first()->telefone }}
                                    @else
                                        Nenhum telefone registrado
                                    @endif
                                </td>
                                <td>{{$usuario->genero}}</td>
                                <td>
                                    @php
                                        $obras = $usuario->obras()->get();
                                    @endphp

                                    @if ($obras->isNotEmpty())
                                        @foreach ($obras as $index => $obra)
                                            {{ $obra->nome }}
                                            @if ($index !== $obras->count() - 1)
                                                , <!-- Adicione um separador se não for o último relacionamento -->
                                            @endif
                                        @endforeach
                                    @else
                                        Nenhuma
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-primary btn-sm me-2" onclick="exibirDetalhesUsuario({{ json_encode($usuario)}},{{ $usuario->telefones }} )">Visualizar</a>
                                        <form action="{{ route('usuarios.deletar', ['id' => $usuario->idUsuario]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
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

    {{--modal de cadastro--}}
    <x-modal-visualizar-usuario />
    {{--Fim modal de cadastro--}}

    {{--modal de cadastro--}}
    <x-modal-cadastro-usuario />
    {{--Fim modal de cadastro--}}

   <!-- Minimodal para inserir o termo de busca -->
        <div class="modal fade" id="miniModalBuscar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buscar Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="termoBusca" class="form-control" placeholder="Digite o nome do usuário" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" id="btnConfirmarBusca">Buscar</button>
                    </div>
                </div>
            </div>
        </div>


    {{--script CDN inputmask(formatação de valores)--}}
    <script src="https://cdn.jsdelivr.net/npm/inputmask"></script>
    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/inputmask.min.js"></script>
    {{--Fim do script CDN inputmask(formatação de valores)--}}



    <script src="{{secure_asset('js/viewUsuario.js')}}"></script>




@endsection

