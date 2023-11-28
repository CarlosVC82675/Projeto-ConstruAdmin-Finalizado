@extends('site.siteMenu.teste2')
@section('conteudo')

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-4 mt-4">
            <h4>Gerenciamento de Usuários</h4>
        </div>
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
                                <img src="{{url("img/gerenciarUsuarios.png")}}" class="img-fluid illustration-img" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          

            {{--aqui--}}
        </div>
        {{-- tabela --}}
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
                        <li><a href="#" class="dropdown-item">Nome</a></li>
                        <li><a href="#" class="dropdown-item">Cargo</a></li>
                        <li><a href="#" class="dropdown-item">Departamento</a></li>
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
                                <th scope="col">Função</th>
                                <th scope="col">Relacionado</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <th scope="row">{{$usuario->idUsuario}}</th>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->lastName}}</td>
                                <td>{{ $usuario->telefones()->first()->telefone}}</td>
                                <td>{{$usuario->genero}}</td>
                                <td>{{$usuario->getRoleNames()}}</td>
                                <td>
                                    {{ optional($usuario->obras()->first())->nome ?? 'Nenhuma' }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-primary btn-sm me-2" onclick="exibirDetalhesUsuario({{ json_encode($usuario)}}, '{{ $usuario->getRoleNames() }}', {{ $usuario->telefones }} )">Visualizar</a>
                                        <form action="{{ route('usuarios.deletar', ['id' => $usuario->idUsuario]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary btn-sm me-2" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card border=0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mt-2">Lista de Clientes</h5>
                <div class="dropdown text-end">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Opções
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><span class="dropdown-header">Filtrar:</span></li>
                        <li><a href="#" class="dropdown-item">Nome</a></li>
                        <li><a href="#" class="dropdown-item">Cargo</a></li>
                        <li><a href="#" class="dropdown-item">Departamento</a></li>
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
                                <th scope="col">Função</th>
                                <th scope="col">Relacionado</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <th scope="row">{{$usuario->idUsuario}}</th>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->lastName}}</td>
                                <td>{{ $usuario->telefones()->first()->telefone}}</td>
                                <td>{{$usuario->genero}}</td>
                                <td>{{$usuario->getRoleNames()}}</td>

                                <td>
                                    {{ optional($usuario->obras()->first())->nome ?? 'Nenhuma' }}
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-primary btn-sm me-2" onclick="exibirDetalhesUsuario({{ json_encode($usuario)}}, '{{ $usuario->getRoleNames() }}', {{ $usuario->telefones }} )">Visualizar</a>
                                        <form action="{{ route('usuarios.deletar', ['id' => $usuario->idUsuario]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary btn-sm me-2" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
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
                <input type="text" class="form-control" name="lastName" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Atribuição</label>
                <input type="text" class="form-control" name="atribuicao" value" placeholder="" required>
              </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="" value="" required>
                </div>
            </div>
                <div class="col-md-4">
                    <label class="form-label">Sexo</label>
                    <input type="text" class="form-control" name="genero" value" placeholder="" required>
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
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>

   <x-modal-cadastro-usuario />


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Passe os dados do Laravel para o JavaScript
    const dadosGrafico = @json($dados);

    console.log(dadosGrafico);
    // Carregue a biblioteca do Google Charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(desenharGrafico);

    function desenharGrafico() {
        const data = new google.visualization.DataTable();
        data.addColumn('string', 'Categoria');
        data.addColumn('number', 'Total');

        // Adicione os dados ao gráfico
        dadosGrafico.forEach(dado => {
            data.addRow([dado.categoria, parseInt(dado.total)]);
        });


        const options = {
            title: 'Distribuição por Categoria',
            pieSliceText: 'value',
            is3D: true,
        };

        const chart = new google.visualization.PieChart(document.getElementById('graficoPizza'));
        chart.draw(data, options);
    }
</script>


@endsection

