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
                        @foreach ($usuarios as $usuario)
                        @if ($usuario->hasRole('Supervisor'))
                            <option value="{{ $usuario->idUsuario }}">Supervisor: {{ $usuario->name }}
                            </option>
                        @endif
                        @endforeach
                        @foreach ($usuarios as $usuario)
                            @if ($usuario->hasRole('Apontador'))
                                <option value="{{ $usuario->idUsuario }}">Apontador: {{ $usuario->name }}
                                </option>
                            @endif
                        @endforeach
                        @foreach ($usuarios as $usuario)
                            @if ($usuario->hasRole('Engenheiro'))
                                <option value="{{ $usuario->idUsuario }}">Engenheiro: {{ $usuario->name }}
                                </option>
                            @endif
                        @endforeach
                        @foreach ($usuarios as $usuario)
                            @if ($usuario->hasRole('Comum'))
                                <option value="{{ $usuario->idUsuario }}">Comum: {{ $usuario->name }}
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
