@extends('site.siteObra.layoutdentro')
@section('title','Editando')
@section('conteudo')

<div class="mt-4">
<nav class="navbar navbar-light bg-body-tertiary ">
  <div id="teste_a" class="container-fluid text-center">
      <span class="navbar-text">
          Criar Obra
      </span>
  </div>
</nav>





<form enctype="multipart/form-data" class="col-8 offset-2 " action="{{route('adicionarAtividade')}}" method="POST">
  @csrf
  <div class="row mb-4">
    <div class="col-12">

<!-- ID input -->
<div data-mdb-input-init class="form-outline mb-4">
 
  <input name='card_atividades_idCard' type="hidden" class="form-control" placeholder="{{$idCard}}" value="{{$idCard}}"  readonly/>
</div>



      <div data-mdb-input-init class="form-outline">
        <input placeholder="Placeholder" name='nome' type="text" class="form-control" />
        <label class="form-label" for="form6Example1">Nome da Atividade</label>
      </div>
    </div>
  </div>

  <!-- Text input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input name='dtInicial' type="date" class="form-control" />
    <label class="form-label" for="form6Example3">Data de Inicio</label>
  </div>

  <!-- Text input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input name='dtFinal' type="date" class="form-control" />
    <label class="form-label" for="form6Example4">Data de Termino</label>
  </div>

 
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <label class="input-group-text" >STATUS</label>
    </div>
    <select name="status" class="custom-select" id="inputGroupSelect01">
      <option selected value="COMEÇANDO">INIÇIANDO</option>
      <option value="ANDAMENTO">ANDAMENTO</option>
      <option value="FINALIZADO">FINALIZADO</option>
    </select>
  </div>



  

  <!-- Message input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <textarea name='descricao' class="form-control" id="form6Example7" rows="4"></textarea>
    <label class="form-label" for="form6Example7">Descrição</label>
  </div>



 
<div class="row">
  <div class="mb-3 col-6">
    <label for="etiqueta" class="form-label">Etiqueta</label>
    <input type="file"  class="form-control border border-warning" id="etiqueta" name="etiqueta[]" enctype="multipart/form-data" accept="image/*,.pdf" multiple>
    <!--<div id="etiquetaList"></div> -->
</div>
<div class="mb-3 col-6">
    <label for="anexo" class="form-label ">Anexo</label>
    <input type="file"  class="form-control  border border-warning" id="anexo" name="anexo[]" enctype="multipart/form-data" accept="image/*,.pdf" multiple>
   <!-- <div id="anexoList"></div>-->
</div>
</div>


  <!-- Submit button -->
  <button type="submit" name="action" class="btn btn-primary btn-block mb-4">Criar Atividade</button>

</form>

</div>
        @endSection
