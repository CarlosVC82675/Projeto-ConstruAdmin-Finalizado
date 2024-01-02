@extends('site.siteMenu.layoutFora')
@section('title', 'Editando Obra')

@section('conteudo')

    <div style="padding: 10px">
        <H1>Editando</H1>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        @endif

        <form class="row g-3" method="post" action="{{ route('obra.update', ['id' => $obra->idObras]) }}">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="Andamento">

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{ $obra->nome }}">
                <label for="inputAddress" class="form-label">Tamanho</label>
                <input type="text" class="form-control" name="tamanho" placeholder="Tamanho da sua obra"
                    value="{{ $obra->tamanho }}">
            </div>
            <div class="col-md-6">
                <label for="floatingTextarea2">Descrição</label>
                <div class="form-floating">
                    <textarea class="form-control" name="descricao"
                        style="height: 116px;resize: vertical !important; max-height: 116px !important;">
            {{ $obra->descricao }}
        </textarea>
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
                <label for="floatingTextarea2">Proposito</label>
                <div class="form-floating">
                    <textarea class="form-control" name="proposito"
                        style="height: 116px;resize: vertical !important; max-height: 116px !important;">
            {{ $obra->proposito }}
        </textarea>
                </div>
            </div>

            <div class="col-md-6">
                <label for="" class="form-label">Logradouro</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ $obra->logradouro }}"
                    placeholder="Logradouro">
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $obra->bairro }}"
                    placeholder="Bairro">
            </div>
            <div class="col-md-2">
                <label for="" class="form-label">Numero Residencial</label>
                <input type="text" class="form-control" name="numResidencial" value="{{ $obra->numResidencial }}"
                    placeholder="Numero Residencial">
            </div>



            <div class="col-md-6">
                <label for="" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $obra->cidade }}"
                    placeholder="Cidade" required>
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" value="{{ $obra->estado }}"
                    placeholder="Estado" required>
            </div>
            <div class="col-md-2">
                <label for="" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" oninput="buscarCEP()" name="cep" value="{{ $obra->cep }}"
                    placeholder="EX: 40750-226" required>
            </div>

            <div class="col-md-6">
                <label for="" class="form-label">Data de inicio</label>
                <input type="date" class="form-control" name="dtInicial" value="{{ $obra->dtInicial }}"
                    min="2020-01-01" max="2025-12-31" required />
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Data de terminio</label>
                <input type="date" class="form-control" name="dtFinal" value="{{ $obra->dtFinal }}"
                    min="2020-01-01" max="2025-12-31" required />
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>


        </form>

        {{-- script CDN inputmask(formatação de valores) --}}
        <script src="https://cdn.jsdelivr.net/npm/inputmask"></script>
        <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/inputmask.min.js"></script>
        {{-- Fim do script CDN inputmask(formatação de valores) --}}

        <script>
            //formatar cep
            Inputmask("99999-999").mask("#cep");

            function buscarCEP() {

                // chave: gea7Akb2TT2gK7liOo1Dy0TQKz7ieMGr8TddW5PY03jsqDEjlCCOviXPy0LXSDen

                let cep = document.getElementById('cep').value; // Remover espaços em branco
                cep = cep.replace(/_/g, ''); // Remover apenas os traços

                console.log(cep);
                if (cep.length === 9) {
                    const url = `https://brasilaberto.com/api/v1/zipcode/${cep}`;

                    fetch(url)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('CEP não encontrado ou inválido.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            const result = data.result;
                            document.getElementById('cidade').value = result.city;
                            document.getElementById('estado').value = result.state;
                            document.getElementById('logradouro').value = result.street;
                            document.getElementById('bairro').value = result.district;

                        })
                        .catch(error => {
                            console.error('Erro ao buscar o CEP:', error);
                        });
                }
            }
        </script>



    @endsection
