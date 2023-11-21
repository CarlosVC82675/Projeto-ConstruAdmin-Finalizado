@extends('site.layoult_base')
@section('tittle','pagina de atividade')
@section('content')





<div class="row">
    @if($successMessage = Session::get('success'))
        <div class="card green">
            <div class="card-content white-text">
                <span class="card-title">Parabéns</span>
                <p>{{ $successMessage }}</p>
            </div>
        </div>
    @endif

    @if($errorVarMessage = Session::get('error_var'))
        <div class="card blue">
            <div class="card-content white-text">
                <span class="card-title">ERRO DE INSERÇÃO DE VARIÁVEL</span>
                <p>{{ $errorVarMessage }}</p>
            </div>
        </div>
    @endif

    @if($errorCriMessage = Session::get('error_cri'))
        <div class="card blue">
            <div class="card-content white-text">
                <span class="card-title">ERRO AO CRIAR A ATIVIDADE</span>
                <p>{{ $errorCriMessage }}</p>
            </div>
        </div>
    @endif



    <form enctype="multipart/form-data" class="col s12 " action="{{route('atividades.adicionarAtividade')}}" method="POST">
      @csrf
      <div class="row">
        <div class="input-field col s6  "  style="margin-top: 40px;">
          <input placeholder="Placeholder" name='nome' type="text" class="validate">
          <label >Nome da Atividade</label>
        </div>
        
      <div class="row">
        <div class="input-field col s6 "  style="margin-top: 40px;">
          <input name='dtFinal' type="date" class="validate">
          <label >data Final</label>
        </div>
      </div>


     
        <div class="input-field col s6">
          <input name='dtInicial' type="date" class="validate">
          <label >data Inicial</label>
        </div>
    
       <div class="row">
          <div class="input-field col s6">
            <input name='status' type="text" class="validate">
            <label >Status</label>
          </div>
        </div> 
   

   
    <div class="row">
      <div class="input-field col s3 offset-s1">
          <input name='Obras_idObras' type="text" class="validate ">
         
          <label >ID da Obra  <i class="material-icons left">vpn_key</i></label>
        </div>
      </div>
  
           
      <div class="row">
        <div class="input-field col s9 offset-s1">
          <input name='descricao' type="text" class="validate">
          <label >Descrição</label>
        </div>
      </div> 


        
     <div class="row">
        <div class="file-field input-field col s3 offset-s2">
            <div class="btn  ">
              <span>Etiqueta</span>
              <input enctype="multipart/form-data" type="file"  name='etiqueta[]' multiple>
            </div>
            <div class="file-path-wrapper">
              <input enctype="multipart/form-data" class="file-path validate"  accept="image/*,.pdf" type="text" placeholder="Upload one or more files">
            </div>
          </div>
    
    

          
      <div class="file-field input-field col s3 offset-s2">
        <div class="btn">
          <span>Anexo</span>
          <input enctype="multipart/form-data" type="file" name='anexo[]'  accept="image/*,.pdf" multiple>
        </div>
        <div class="file-path-wrapper">
          <input  class="file-path validate" type="text" placeholder="Upload one or more files">
        </div>
      </div>
    </div>

    

      <div class="row">
      <button class="btn waves-effect waves-light col 1 offset-s5" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
      </button>
  </div>
    </form>


        @endSection