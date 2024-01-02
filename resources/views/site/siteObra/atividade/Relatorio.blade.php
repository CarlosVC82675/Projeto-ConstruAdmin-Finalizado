@extends('site.siteObra.atividade.layoutdentro2')
@section('title','Relatorio')
@section('conteudo')




<!-- LINKS DE THAUAN -->


<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">



    <!-- Font Awesome -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
rel="stylesheet"
/>
<!-- Google Fonts -->
<link
href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
rel="stylesheet"
/>
<!-- MDB -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css"
rel="stylesheet"
/>


<!-- FIM DOS LINKS -->










<div style="margin-top: 20vh;">

  <!-- SIDE BAR -->
<!--Main Navigation-->


<!-- Brand -->
<header>
<!-- Sidebar -->

<nav id="sidebarMenu" class=" collapse d-lg-block sidebar collapse bg-white">
<div class="position-sticky">
  <div class="list-group list-group-flush mx-3 mt-4">
    <a
      href="#"
      class="list-group-item list-group-item-action py-2 ripple active bg bg-warning"
      aria-current="true"
    >
      <i id="menu_" class="fas fa-tachometer-alt fa-fw me-3"></i><span>Menu Rapido</span>
    </a>
    <a href="{{route('Lista_Responsaveis.Atividade', ['idObra' => $obra->idObras])}}"  class="list-group-item list-group-item-action py-2 ripple"
      ><i class="fas fa-building fa-fw me-3"></i><span>Responsaveis vinculados</span></a
    >
    <a href="{{route('Lista_Funcionario.Atividade', ['idObra' => $obra->idObras])}}" class="list-group-item list-group-item-action py-2 ripple"
      ><i class="fas fa-users fa-fw me-3"></i><span>Funcionarios rasos Vinculados</span></a
    >
    <a href="{{route('Relatorio.Atividade', ['idObra' => $obra->idObras])}}" class="list-group-item list-group-item-action py-2 ripple"
      ><i class="fas fa-calendar fa-fw me-3"></i><span>Relatorio de Atividades</span></a
    >
  


      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main >
    <!-- CABEÇALHO -->

    

    <div class="container pt-4  rounded table-responsive" style="margin-top: 30vh; width:80vw;" >
              <figure>
                <blockquote class="blockquote">
                  <h1 class="text-center">ConstruAdmin  <img src="{{secure_asset("img/capacete.png")}}" alt="Logo da Empresa" width="40" height="40" ></h1>
                </blockquote>
                <figcaption class="text-center">
                  SEU SISTEMA FAVORITO DE GESTÃO DE OBRAS
                </figcaption>
              </figure>
             
      </div>
  


<!-- FIM CABEÇALHO -->
<!-- CORPO -->


    <div class="container pt-4 border rounded table-responsive mb-4" style="margin-top: 20vh; width:70vw;" >
        <h1 class="text-center my-4">RELATORIO DE ATIVIDADES </h1>    
    <table class="table table-bordered text-nowrap ">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Status</th>
            <th scope="col">Criado em</th>
            <th scope="col">Iniciado em</th>
            <th scope="col">Previsão de termino</th>
          </tr>
        </thead>
        <tbody>

@foreach($atividades as $CARD)
@foreach($CARD->atividade as $ATV )
          <tr>
            <th scope="row">{{$ATV->idAtividade}}</th>
            <td>{{$ATV->nome}}</td>
            <td>{{$ATV->status}}</td>
            <td>{{$ATV->created_at}}</td>
            <td>{{$ATV->dtInicial}}</td>
            <td>{{$ATV->dtFinal}}</td>
          </tr>
         


@endforeach
@endforeach

        </tbody>
      </table>

    </div>




</main>






<!-- SCRIPTS DE THAUAN -->







<!-- MDB Toolkit JavaScript -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"
></script>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>




@endsection