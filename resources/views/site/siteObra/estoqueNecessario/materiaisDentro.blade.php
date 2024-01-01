@extends('site.siteObra.layoutdentro')
@section('conteudo')

    <div style="padding: 25px">
        <div class="container mt-5">
            <h2><i class="fa-solid fa-box"></i></i> Materiais Associados a obra</h2>
            <div class="table-responsive">
                @if($materiaisDaObra->count() == 0)
                <div class="card-orange">
                    <div class="card-content white-text">
                        <span class="card-title">Nenhum material associado a essa obra.</span>
                    </div>
                </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Código </th>
                            <th scope="col">Nome</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materiaisDaObra as $materialDaObra)
                                <tr>
                                    <th scope="row">{{$materialDaObra->idMateriais}}</th>
                                    <td>{{$materialDaObra->nomeM}}</td>
                                    <td>{{$materialDaObra->pivot->quantidade}}</td>
                                    <td>
                                        {{-- Inicio com os botoes que ligam ao modal--}}
                                        <div class="btn-group" role="group" aria-label="Operações">
                                            <a class="btn btn-primary btn-sm me-2" onclick="removerNMateriais({{ json_encode($materialDaObra)}})"><i class="fa-solid fa-square-xmark" title="Remover"></i></a>
                                            {{-- Fim com os botoes que ligam ao modal--}}
                                            {{-- começa aq botao desassociar --}}
                                            <form action="{{ route('desassociar.material.obra', ['idMateriais' => $materialDaObra->idMateriais]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="idObra" value="{{ $obra->idObras}}">
                                                <button class="btn btn-danger btn-sm me-2" type="submit" onclick="return confirm('Tem certeza que deseja desassociar esse material?')"><i class="fa-solid fa-trash" title="Desassociar"></i></button>
                                            </form>
                                            {{-- termina aq botao desassociar --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <button type="button" class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#adicionarModalMateriais"> Adicionar </button>
            {{-- Modal para ADICIONAR material a obra--}}
            <div class="modal fade" id="adicionarModalMateriais" tabindex="-1" aria-labelledby="adicionarModalMateriaisLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="adicionarModalMateriaisLabel">ASSOCIAR E ADICIONAR MATERIAIS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="adicionarMaterialForm" action="{{route('associar.material', ['id' => $obra->idObras])}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Insira o código do material que deseja associar a esta obra:</label>
                                    <select class="form-select" aria-label="Default select example" name="id">
                                        @foreach ($materiais as $material)
                                        <option value="{{$material->idMateriais}}">{{$material->nomeM}}</option>
                                        @endforeach
                                    </select>
                                    <label for="" class="form-label">Insira a quantidade que deseja associada a obra:</label>
                                    <input type="number" name="quantidade" class="form-control" required>
                                </div>
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
            {{-- Fim modal para ASSOCIAR material a obra --}}
            {{-- Modal remover materiais necessarios ANA--}}
            <div class="modal fade" id="removerNModalMateriais" tabindex="-1" aria-labelledby="removerNModalMateriaisLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="removerNModalMateriaisLabel">REMOVER MATERIAIS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="removerNMaterialForm" action="" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Insira a quantidade que deseja remover desse material:</label>
                                    <input type="number" name="quantidade" class="form-control" required>
                                    <input type="hidden" name="idObra" value="{{$obra->idObras}}">
                                </div>
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