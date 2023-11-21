@extends('site.layoult_base')
@section('tittle','pagina de atividade')
@section('content')

<div class="row ">
@foreach ($atividades as $atividade)
<div class="col s2" >
<div class="card ">
    <div class="card-image waves-effect waves-block waves-light col s12">
        <img class="activator responsive-img" src="{{$atividade->anexo}}">
    </div>

  
    <div class="card-content">
      <span class="card-title activator orange-text text-darken-12">{{'Titulo: '.$atividade->nome}}<i class="material-icons right"></i></span>
  
     



      <div class="row">
        <p>
            <a href="{{ route('delete_atv', ['idAtividade' => $atividade->idAtividade]) }}">
                <i class="material-icons left red-text">delete_forever APAGAR</i>
            </a>
        </p>
    </div>

         
    <div class="row">
      <a href="{{ route('editar_atv', ['idAtividade' => $atividade->idAtividade]) }}">
          <i class="material-icons left green-text">edit EDITAR</i>
      </a>
  </div>
        
         
    </div>

    <div class="card-reveal ">
      <div class="row">
      <span class="card-title grey-text text-darken-4">{{'Titulo: '.$atividade->nome}}<i class="material-icons right">X</i></span>
      
      @foreach ($atividade->usuarios as $usuario)
      {{ 'RESPONSAVEL:  ' .$usuario->nome }}
  @endforeach
</div>
      <p>{{'DESCRICAO:  ' .$atividade->descricao}}</p>
    </div>
  </div>
</div>


@endforeach

</div>

@endSection