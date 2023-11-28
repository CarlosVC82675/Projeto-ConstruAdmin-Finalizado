@extends('site.siteObra.layoutdentro')
@section('conteudo')


<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-4 mt-4">
            <h4>Dashboard</h4>
        </div>
        <div class="row">
            <div class="col-10 col-md-6 d-flex d-none d-md-block">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body p-0 d-flex flex-fill">
                        <div class="row g-0 w-100">
                            <div class="col-12">
                                <div class="p-3 m-1">
                                    <h4>Bem vindo</h4>
                                    <p class="mb-0">Essa sessão é exclusivamente feita para fazer o gerenciamento de usuários. Se tiver dúvidas, consulte o Manual: <span>"Como gerenciar meus usuários"</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <!-- Mapa -->
                                <div id="map" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Bungas</td>
                                <td>Bungas</td>
                                <td>Bungas</td>
                                <td>
                                    <a class="btn btn-primary custom-btn me-2" data-bs-toggle="modal" data-bs-target="#visualizarModal">Visualizar</a>
                                </td>
                            </tr>
                            <!-- Outras linhas... -->
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
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Bungas</td>
                                <td>Bungas</td>
                                <td>Bungas</td>
                                <td>
                                    <a class="btn btn-primary custom-btn me-2" data-bs-toggle="modal" data-bs-target="#visualizarModal">Visualizar</a>
                                </td>
                            </tr>
                            <!-- Outras linhas... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
   </main>

   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeE0srg4Hi9V4R1D8VCZoTUPyfMpMlprU&callback=initMap" async defer></script>
   <script>
    function initMap() {
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
@endsection
