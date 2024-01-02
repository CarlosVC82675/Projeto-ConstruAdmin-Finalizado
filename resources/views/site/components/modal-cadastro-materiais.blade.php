{{-- modal materiais ANA --}}

<div class="modal fade" id="cadastroModalMateriais" tabindex="-1" aria-labelledby="cadastroModalMateriaisLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cadastroModalMateriaisLabel">CADASTRO DE MATERIAIS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3"  action="{{route('registrar.material')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="Estoque_idEstoque" value="1">

          <div class="col-md-6">
            <label for="">Nome do material:</label>
            <input type="text" name="nomeM" class="form-control form-control-sm" required>
          </div>
          
          <div class="col-md-6">
            <label for="">Peso em quilos:</label>
            <input type="number" name="kg" class="form-control form-control-sm" min="0" step="any" required>
          </div>

          <div class="col-md-6">
            <label for="">Metros:</label>
            <input type="number" name="metros" class="form-control form-control-sm" min="0" step="any">
          </div>

          <div class="col-md-6">
            <label for="">Quantidade:</label>
            <input type="number" name="quantidade" min="1" class="form-control form-control-sm" required>
          </div>

          <div class="col-md-6">
            <label for="">Data de Vencimento:</label>
            <input type="date" name="dtVencimento" class="form-control form-control-sm">
          </div>

          <div class="col-md-6">
            <label for="">Status:</label>
            <select name="Status_2" class="form-control form-control-sm">
              <option value="novo">Material novo</option>
              <option value="usado">Material Usado</option>
            </select>
          </div>

          <input type="hidden" name="dtEntrada" value="{{now()}}">

          <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </form>

        @if ($errors->any())
          {{-- Se houver algum erro, ele vai percorrer os erros --}}
          @foreach ($errors->all() as $error)
            {{$error}}<br>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</div>