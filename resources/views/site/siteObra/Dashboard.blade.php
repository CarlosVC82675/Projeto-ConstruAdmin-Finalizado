@extends('site.siteObra.layoutdentro')
@section('title','Dashboard')
@section('conteudo')


<main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-4 mt-4">
                        <h4>Dashboard</h4>
                    <!-- Linha com os cards de usuários ativos, atividades cadastradas e materiais utilizados -->
                    <div class="row mb-4">

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Usuários Ativos</h5>
                                    <p class="card-text">Número de usuários ativos: {{$usuariosDaObra->count()}}</p>
                                    <!-- Adicione aqui os detalhes sobre os usuários ativos -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Atividades Cadastradas</h5>
                                    <p class="card-text">Número de atividades cadastradas: {{$atividadesDaObra->count()}}</p>
                                    <!-- Adicione aqui os detalhes sobre as atividades cadastradas -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Materiais Utilizados</h5>
                                    <p class="card-text">Número de materiais utilizados: {{$totalQuantidade}}</p>
                                    <!-- Adicione aqui os detalhes sobre os materiais utilizados -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Linha com o primeiro gráfico e o mapa -->
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Gráfico de Progressão</h5>
                                    <!-- Adicione o código do gráfico de progressão aqui -->
                                    <canvas id="myChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div id="map" style="height: 400px"></div>
                        </div>
                    </div>

                    <!-- Linha com o segundo gráfico e a lista de usuários e atividades -->
                    <div class="row">
                        <div class="d-none d-md-block col-md-6 col-12">

                            @if (isset($dadosGrafico['data']) && !empty($dadosGrafico['data']))
                            <!-- Se houver dados no array 'data', exibir o gráfico -->
                            <div class="border rounded">
                            <canvas id="myChart2" width="400" height="200" style="margin-left: 130px;"></canvas>
                            </div>
                            @else
                                <!-- Se 'data' estiver vazio, exibir uma mensagem alternativa -->
                                <div class="alert alert-info" role="alert">
                                    Ainda não há dados suficientes para exibir o gráfico abaixo: "Materiais Utilizados".
                                </div>
                            @endif

                        </div>
                        <div class="col-md-6 col-12">
                            <h5>Usuários Associados à Obra</h5>
                            <ul class="list-group" id="listaUsuarios">
                                @php
                                    $limiteUsuarios = 5; // Defina o limite de usuários a serem exibidos inicialmente
                                    $usuariosRestantes = $usuariosDaObra->count() - $limiteUsuarios;
                                @endphp

                                @foreach ($usuariosDaObra->take($limiteUsuarios) as $usuario)
                                    <li class="list-group-item d-flex align-items-center">
                                            @if($usuario->genero == 'MASCULINO')
                                            <img src="{{ secure_asset('img/avatar.png') }}" class="rounded-circle me-3" width="40" height="40" alt="Foto do Usuário">
                                            @else
                                            <img src="{{ secure_asset('img/avatarFeminine.png') }}" class="rounded-circle me-3" width="40" height="40" alt="Foto do Usuário">
                                            @endif
                                        <div>
                                            <h5>{{ $usuario->name }}</h5>
                                            <p>{{$usuario->genero}}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="dropdown d-flex align-items-start mt-2">
                                <button class="btn btn-secondary dropdown-toggle me-3" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Ações
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#usuarioassociar">Associar</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#desassociar">Desassociar</button>
                                    </li>
                                </ul>
                                <div class="ms-auto">
                                    @if ($usuariosRestantes > 0)
                                        <button class="btn btn-primary me-2 mt-2" onclick="mostrarMais()">Mostrar mais</button>
                                    @endif
                                    @if ($usuariosDaObra->count() > $limiteUsuarios)
                                        <button class="btn btn-primary mt-2" onclick="mostrarMenos()">Mostrar menos</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Modal para associar os usuarios -->
            <div class="modal fade" id="usuarioassociar" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cadastroModalLabel">Associando Funcionários</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('usuarios.associar') }}" id="formUsuarioAssociando" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h2>Selecione os funcionários para essa obra:</h2>
                                <select name="usuarios[]" multiple class="form-select" multiple
                                    aria-label="multiple select example">>
                                    @foreach ($usuarios as $usuario)
                                    @php
                                        $associado = $usuario->obras->contains('idObras', $obra->idObras);
                                    @endphp
                                    @if (!$associado)
                                        @if ($usuario->hasRole('Supervisor'))
                                            <option value="{{ $usuario->idUsuario }}">Supervisor: {{ $usuario->name }}</option>
                                        @endif
                                        @if ($usuario->hasRole('Apontador'))
                                            <option value="{{ $usuario->idUsuario }}">Apontador: {{ $usuario->name }}</option>
                                        @endif
                                        @if ($usuario->hasRole('Engenheiro'))
                                            <option value="{{ $usuario->idUsuario }}">Engenheiro: {{ $usuario->name }}</option>
                                        @endif
                                        @if ($usuario->hasRole('Comum'))
                                            <option value="{{ $usuario->idUsuario }}">Comum: {{ $usuario->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                                </select>
                                <input type="hidden" name="obra_id" value="{{$obra->idObras}}">
                                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
             <!-- Fim do Modal para associar os usuarios -->

            <!-- Modal para dessassociar os usuarios -->
            <div class="modal fade" id="desassociar" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cadastroModalLabel">Desassociar Funcionários</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('usuarios.desassociar') }}" id="formdesassociando" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h2>Selecione os funcionários para essa obra:</h2>
                                <select name="usuarios[]" multiple class="form-select" multiple
                                    aria-label="multiple select example">>
                                    @foreach ($usuarios as $usuario)
                                    @php
                                        $associado = $usuario->obras->contains('idObras', $obra->idObras);
                                    @endphp
                                    @if ($associado)
                                        @if ($usuario->hasRole('Supervisor'))
                                            <option value="{{ $usuario->idUsuario }}">Supervisor: {{ $usuario->name }}</option>
                                        @endif
                                        @if ($usuario->hasRole('Apontador'))
                                            <option value="{{ $usuario->idUsuario }}">Apontador: {{ $usuario->name }}</option>
                                        @endif
                                        @if ($usuario->hasRole('Engenheiro'))
                                            <option value="{{ $usuario->idUsuario }}">Engenheiro: {{ $usuario->name }}</option>
                                        @endif
                                        @if ($usuario->hasRole('Comum'))
                                            <option value="{{ $usuario->idUsuario }}">Comum: {{ $usuario->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                                </select>
                                <input type="hidden" name="obra_id" value="{{$obra->idObras}}">
                                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim do Modal para dessassociar os usuarios -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeE0srg4Hi9V4R1D8VCZoTUPyfMpMlprU&callback=initMap" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        // Obtenha o contexto do elemento canvas
        var ctx = document.getElementById('myChart').getContext('2d');

        // Crie um gráfico de barras
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Atividades Feitas', 'Atividades Pendentes'],
                datasets: [{
                    label: 'Status das Atividades',
                    data: [
                        {{ count($atividadesFeitas) }}, // Quantidade de atividades feitas
                        {{ count($atividadesPendentes) }} // Quantidade de atividades pendentes
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)', // Cor para atividades feitas
                        'rgba(255, 99, 132, 0.2)' // Cor para atividades pendentes
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>

<script>
    const ctx2 = document.getElementById('myChart2').getContext('2d');
    const cores = generateRandomColors(<?php echo count($dadosGrafico['labels']); ?>);
    const chartSize = 500;

    const myChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($dadosGrafico['labels']); ?>,
            datasets: [{
                label: 'Porcentagem de Materiais',
                data: <?php echo json_encode($dadosGrafico['data']); ?>,
                backgroundColor: cores,
                borderWidth: 1
            }]
        },
        options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Porcentagem de Materiais Utilizados',
                font: {
                    size: 18
                }
            },
            legend: {
                position: 'right',
            },
        },
    },
    });

    document.getElementById('myChart2').style.width = chartSize + 'px';
    document.getElementById('myChart2').style.height = chartSize + 'px';

    function generateRandomColors(numColors) {
        const randomColors = [];
        for (let i = 0; i < numColors; i++) {
            const color = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.7)`;
            randomColors.push(color);
        }
        return randomColors;
    }
</script>

<script>
    function initMap() {
        console.log({{$obra->cep}});
        var cep = "{{$obra->cep}}"; // Exemplo de CEP
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({ 'address': cep }, function(results, status) {
            if (status === 'OK') {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: results[0].geometry.location,
                    zoom: 15
                });

                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    title: 'Localização do CEP'
                });
            } else {
                alert('Geocodificação falhou devido a: ' + status);
            }
        });
    }
</script>

<script>
    let usuariosExibidos = {{ $limiteUsuarios }};
    const usuarios = @json($usuariosDaObra);

    function mostrarMais() {
    const lista = document.getElementById('listaUsuarios');
    const limiteUsuarios = 5; // Defina quantos usuários adicionar a cada clique
    const totalUsuarios = usuarios.length;

    for (let i = usuariosExibidos; i < usuariosExibidos + limiteUsuarios; i++) {
        const usuario = usuarios[i];
            if (usuario) {
                const itemLista = document.createElement('li');
                itemLista.className = 'list-group-item d-flex align-items-center';

                // Definindo a URL da imagem com base no gênero do usuário
                const genero = usuario.genero === 'MASCULINO' ? 'avatar.png' : 'avatarFeminine.png';
                const imgUrl = `{{ secure_asset('img/') }}/${genero}`;

                itemLista.innerHTML = `
                    <img src="${imgUrl}" class="rounded-circle me-3" width="40" height="40" alt="Foto do Usuário">
                    <div>
                        <h5>${usuario.name}</h5>
                        <p>${usuario.genero}</p>
                    </div>
                `;
                lista.appendChild(itemLista);
                usuariosExibidos++;

                if (usuariosExibidos >= totalUsuarios) {
                    document.querySelector('button').style.display = 'none';
                    break;
                }
            } else {
                document.querySelector('button').style.display = 'none';
                break;
            }
        }
    }

    function mostrarMenos() {
        const lista = document.getElementById('listaUsuarios');
        const limiteUsuarios = 5; // Defina quantos usuários remover a cada clique

        for (let i = 0; i < limiteUsuarios; i++) {
            const ultimoItem = lista.lastElementChild;
            if (ultimoItem) {
                lista.removeChild(ultimoItem);
                usuariosExibidos--;
                usuariosRemovidos++;

                if (usuariosRemovidos >= usuariosExibidos) {
                    // Se todos os usuários adicionados inicialmente foram removidos, esconde o botão "Mostrar menos"
                    document.querySelector('button[onclick="mostrarMenos()"]').style.display = 'none';
                    break;
                }
            } else {
                break;
            }
        }

        // Após remover usuários, exibe o botão "Mostrar mais"
        document.querySelector('button[onclick="mostrarMais()"]').style.display = 'block';
    }
</script>



@endsection
