
@extends('site.siteObra.atividade.layoutdentro2')
@section('title','ListagemFuncionario')
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
<main>
@if($Usuarios->count()>0)

<div>
<div class="note note-warning mb-3" style="margin-top: 30vh; width:70vw;margin-left:5vw;" >
    <strong>Nota de aviso:</strong> parte destinada a lista de funcionarios de baixo/medio nivel vinculados a atividade, que não fazem parte da administração da obra de acordo com as atribuições no sistema.<br>
    <strong> ISSO NÃO REFLETE O CARGO REAL DO FUNCIONARIO EXTERNAMENTE AO SISTEMA</strong>
  </div>


<div class="container pt-4 border rounded table-responsive" style="margin-top: 10vh; width:70vw;" >
    <div class="card-header my-4 text-center ">
        <h5 class="card-title mt-2">LISTA DE FUNCIONARIOS RASOS</h5>
    </div>
    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
          <tr>
            <th>Nome</th>
            <th>Atribuição</th>
            <th >Sexo</th>
            <th>Numero de atividades</th>
            <th></th>
          </tr>
        </thead>
        <tbody>

            @foreach($Usuarios as $user )
    @php
    $count = $user->atividades->count();
    @endphp

@foreach($user->roles as $role)
<!-- Aqui seria a parte que apareceria todos menos cliente e supervisor -->
@if(strcasecmp($role->name, 'Cliente')  && strcasecmp($role->name, 'Supervisor'))
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <img
                    src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                    alt=""
                    style="width: 45px; height: 45px"
                    class="rounded-circle"
                    />
                <div class="ms-3">
                  <p class="fw-bold mb-1">{{$user->name}}</p>
                  <p class="text-muted mb-0">{{$user->email}}</p>
                </div>
              </div>
            </td>
            <td>
              <p class="fw-normal mb-1">{{$role->name}}</p>
            </td>
            <td>
                @if(strcasecmp($user->genero, 'Feminino'))
              <span class="badge badge-primary rounded-pill d-inline">{{$user->genero}}</span>
              @else
              <span class="badge badge-danger rounded-pill d-inline">{{$user->genero}}</span>
              @endif
            </td>
            <td class="text-center">{{$count}}</td>
            <td>
            </td>
          </tr>
          @endif
          @endforeach
          @endforeach
        </tbody>
      </table>

   



</div>
@else
<div class="d-flex align-items-center justify-content-center">
<div class="card text-center border border-warning "  style="margin-top: 20vh; width:50vw;" >
    <div class="card-header ">AVISO!</div>
    <div class="card-body">
      <h5 class="card-title">Não encontramos Funcionarios vinculados a atividades</h5>
      <p class="card-text">Provavelmente voce não tem atividade registrada ou não tem funcionarios rasos 
        atribuidos a alguma atividade
      </p>
      <a href="{{route('Atividade.Kanban', ['id' => $obra->idObras]) }}" class="btn btn-warning" data-mdb-ripple-init>Vamos criar uma atividade!</a>
    </div>
    <div class="card-footer text-muted mb-4"></div>
  </div>
</div>
</div>
@endif

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




