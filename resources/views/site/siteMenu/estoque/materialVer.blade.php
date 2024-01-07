@extends('site.siteMenu.layoutFora')
@section('conteudo')
    <div style="padding: 25px">
        <div class="container mt-5">
            <h2><i class="fa-solid fa-box"></i></i> Materiais estocados</h2>
            <div class="table-responsive">
                @if($materiais->count() == 0)
                <div class="card orange">
                    <div class="card-content white-text">
                        <span class="card-title">Estoque vazio, cadastre um material!</span>
                    </div>
                </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Código </th>
                            <th scope="col">Nome</th>
                            <th scope="col">Peso(kg)</th>
                            <th scope="col">Tamanho</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Validade</th>
                            <th scope="col">Saída</th>
                            <th scope="col">Data de Entrada</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materiais as $material)
                                <tr>
                                    <th scope="row">{{$material->idMateriais}}</th>
                                    <td>{{$material->nomeM}}</td>
                                    <td>{{$material->kg}}</td>
                                    <td>{{number_format($material->metros, 2)}}</td>
                                    <td>{{$material->quantidade}}</td>
                                    <td>@if ($material->dtVencimento)
                                        {{ \Carbon\Carbon::parse($material->dtVencimento)->format('d/m/Y') }}
                                    @else
                                        N.T.
                                    @endif</td>
                                    <td>@if ($material->dtSaida)
                                        {{ \Carbon\Carbon::parse($material->dtSaida)->format('d/m/Y') }}
                                    @else
                                        N.T.
                                    @endif</td>
                                    <td>{{\Carbon\Carbon::parse($material->dtEntrada)->format('d/m/Y')}}</td>
                                    <td>{{$material->Status_2}}</td>
                                    <td>
                                        {{-- Inicio com os botoes que ligam ao modal--}}
                                        <div class="btn-group" role="group" aria-label="Operações">
                                            <a class="btn btn-primary btn-sm me-2" onclick="adicionarMateriais({{ json_encode($material)}})"><i class="fa-solid fa-square-plus" title="Adicionar"></i></a>

                                            <a class="btn btn-primary btn-sm me-2" onclick="removerMateriais({{ json_encode($material)}})"><i class="fa-solid fa-square-xmark" title="Remover"></i></a>

                                            <a class="btn btn-primary btn-sm me-2" onclick="editarMateriais({{ json_encode($material)}})"><i class="fa-regular fa-pen-to-square" title="Editar"></i></a>
                                            {{-- Fim com os botoes que ligam ao modal--}}
                                            <form action="{{route('deletar.material', ['id' => $material->idMateriais])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm me-2" type="submit" onclick="return confirm('Tem certeza que deseja deletar?')"><i class="fa-solid fa-trash" title="Excluir"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
           
            <button type="button" class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#cadastroModalMateriais"> Cadastrar </button>
            {{-- Modal adicionar materiais ANA--}}
            <div class="modal fade" id="adicionarModalMateriais" tabindex="-1" aria-labelledby="adicionarModalMateriaisLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered"> <!-- Alterei para modal-md -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="adicionarModalMateriaisLabel">ADICIONAR MATERIAIS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="adicionarMaterialForm" action="" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="quantidade" class="form-label">Insira a quantidade de materiais que deseja adicionar:</label>
                                    <input type="number" name="quantidade" min="1" class="form-control" required>
                                    <input type="hidden" name="dtEntrada">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-secondary btn-sm">Enviar</button>
                                </div>
                            </form>
                            @if ($errors->any())
                                {{-- Se houver algum erro, ele vai percorrer os erros --}}
                                @foreach ($errors->all() as $error )
                                    {{$error}}<br>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- FIM Modal adicionar materiais ANA--}}
            {{-- Modal remover materiais ANA--}}
            <div class="modal fade" id="removerModalMateriais" tabindex="-1" aria-labelledby="removerModalMateriaisLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="removerModalMateriaisLabel">REMOVER MATERIAIS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="removerMaterialForm" action="" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="quantidadeRemover" class="form-label">Insira a quantidade que deseja remover desse material:</label>
                                    <input type="number" name="quantidade" min="1" class="form-control" id="quantidadeRemover" required>
                                </div>
                                <input type="hidden" name="dtSaida" value="{{ now() }}">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-secondary btn-sm me-2">Enviar</button>
                                </div>
                            </form>

                            @if (session('erro'))
                                <div class="alert alert-danger">
                                    {{ session('erro') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- FIM Modal remover materiais ANA--}}
           {{-- Inicio Modal EDITAR materiais ANA --}}
           <div class="modal fade" id="editarModalMateriais" tabindex="-1" aria-labelledby="editarModalMateriaisLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalMateriaisLabel">EDITAR MATERIAIS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editarMaterialForm" action="" method="POST">
                            @csrf
                            @method('put')

                            <input type="hidden" name="Estoque_idEstoque" value="1">

                            <div class="mb-3">
                                <label for="nomeM" class="form-label">Nome do material:</label>
                                <input type="text" name="nomeM" class="form-control" placeholder="" value="" required>
                            </div>

                            <div class="mb-3">
                                <label for="kg" class="form-label">Peso em quilos:</label>
                                <input type="number" name="kg" class="form-control" min="0" step="any" placeholder="" min="0" value="" required>
                            </div>

                            <div class="mb-3">
                                <label for="metros" class="form-label">Metros:</label>
                                <input type="number" name="metros" min="0" class="form-control" step="any" placeholder="" value="">
                            </div>

                            <div class="mb-3">
                                <label for="dtVencimento" class="form-label">Data de Vencimento:</label>
                                <input type="date" name="dtVencimento" class="form-control" placeholder="" value="">
                            </div>

                            <div class="mb-3">
                                <label for="">Status:</label>
                                <select name="Status_2" value="" class="form-control form-control-sm">
                                    <option value="novo">Material novo</option>
                                    <option value="usado">Material Usado</option>
                                </select>
                            </div>

                            <input type="hidden" name="dtEntrada" value="{{now()}}">

                            <div class="text-end">
                                <button type="submit" class="btn btn-secondary btn-sm">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            {{-- FIM Modal EDITAR materiais ANA --}}
            @if ($errors->any())
                        {{--se haver algum erro ele vai pecorrer os erros--}}
                        @foreach ($errors->all() as $error )
                            {{$error}}<br>
                        @endforeach
                        @endif

                        @if (session('erro'))
                                <div class="alert alert-danger">
                                    {{ session('erro') }}
                                </div>
                        @endif
        </div>
    </div>
    <x-modal-cadastro-materiais/>
    <script src="{{secure_asset("js/modalMaterias.js")}}"></script>
@endsection
