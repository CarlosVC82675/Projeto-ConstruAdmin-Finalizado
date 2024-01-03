@extends('site.siteObra.atividade.layoutdentro2')
@section('title','Atividades')
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
  <div class="container pt-4">

<!--Main layout-->

  <nav class=" card navbar-brand bg-body-tertiary  mx-auto mt-auto">
      <div id="teste_a" class="container-fluid">
        <span class="navbar-text ">
      Atividades da {{$obra->nome}}
        </span>
      </div>
   </div>
   <button
   class="navbar-toggler d-xl-none"
   type="button"
   data-bs-toggle="collapse"
   data-bs-target="#sidebarMenu"
   aria-controls="sidebarMenu"
   aria-expanded="false"
   aria-label="Toggle navigation"
>
   <i class="fas fa-bars"></i>
</button>

<div class="container-fluid  p-2 col-md-12  " style="white-space: wrap; overflow-y:hidden; overflow-x:scroll;  height:70vh;">
    <div class="row">
        <div class="col-md-12 offset-md-1" >







     <!-- CORPO PRINCIPAL DOS CARDS -->
    <div class=" d-flex justify-content-start  col-md-12  "  >
        @if (isset($cardAtividade) && $cardAtividade->count() > 0)
            @foreach ($cardAtividade as $card)

            <div class="col-md-4  mx-4 bg-warning bg-opacity-25 border border-warning rounded p-3 rounded " >

              <!-- BOTAO MODAL CARD -->

              <div class="row d-flex justify-content-around" >

                <div class=" dropdown">

                  <button
                  class="btn btn-light border border-success btn-lg btn-floating mx-1 "
                    type="button"
                    id="dropdownMenuButton"
                    data-mdb-dropdown-init
                    data-mdb-ripple-init
                    aria-expanded="false"
                  >
                  <i class="fas fa-circle-plus fa-lg text-success"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li> <button
                      type="button"
                      class="btn btn-primary create-activity" style="min-width: 100%;"
                      data-card='@json($card)'
                      data-mdb-ripple-init
                      data-mdb-toggle="modal"
                      data-mdb-target="#ModalCriarAtividade"
                      id="openModalButton"
                     >
                     Adicionar Atividade
                     </button></li>
                    <li><button type="button" class="  btn btn-warning "style="min-width: 100%;"
                      data-mdb-ripple-init
                      data-mdb-modal-init
                      data-mdb-target="#exampleModal">
                       Criar novo card
                      </button></li>
                  </ul>
                </div>







</div>
                <div class="border-0   my-4 d-flex  card card text-center bg-white bg-opacity-40 border border-dark mx-2 " style="max-height: 40vh;overflow-y: auto; min-height: 20vh;">








                  <!-- PARTE DO CARD ONDE TEM COMO CRIAR ATV  -->
                        <div class="card-header border-0" >
                          <h4><span class="badge badge-warning container-fluid"> {{ $card->titulo }}</span></h4>

                        </div>
                    <div class="card-body   ">
                        <div id="areaCards" >

                            <!-- CORPO PRINCIPAL DOS CARDS DAS ATIVIDADES -->
                            @if (isset($card->atividade) && $card->atividade->count() > 0 )
                                @foreach ($card->atividade as $atividade)

                                <div class="card mt-3 border  "style=" overflow-y: auto;overflow-x: hidden;  max-width:60vh;white-space: wrap;">
                                    <div class="card-body position-relative"  >
                                        <h5 class="card-title"><strong>  Atividade: {{ $atividade->nome }}</strong> </h5>




<!-- BOTAO DO MODAL PARA COMENTARIO -->
                                        <div class=" col-12 d-flex justify-content-center ">


                                            <a class="navbar-brand my-3 mx-3 h1  view-coments"
                                            @if (isset($card->atividade) && $card->atividade->count() > 0 )
                                            data-atividade='@json($atividade)'
                                            data-auth-id='{{ auth()->id() }}'
                                            data-mdb-ripple-init
                                            data-mdb-toggle="modal"
                                            data-mdb-target="#myModal"
                                            @endif
                                            >
                                            <i class="bi bi-chat-right-quote"></i>
                                            </a>




  <!-- BOTAO MODAL VIEW E EDIT ATIVIDADE -->
  <a class="navbar-brand my-3 mx-3 h1 view-activity"
data-atividade='@json($atividade)'
data-mdb-ripple-init
data-mdb-toggle="modal"
data-mdb-target="#staticBackdrop"
>
<i class="bi bi-eye"></i>
</a>


                                            <a class="navbar-brand my-3 mx-3  h1"><i class="bi bi-exclamation-triangle"></i></a>
                                        </div>


                                    <!-- PARTE DOS STATUS COLORIDOS NOS CARDS -->
                                        @if($atividade->status == 'COMEÇANDO')
                                            <div class="position-absolute top-0 end-0  rounded" style="height: 100%; width: 10%;background: linear-gradient(90deg, rgb(198, 255, 206) 9%, rgb(169, 255, 116) 58%, rgb(81, 241, 52) 100%);"></div>
                                        @elseif($atividade->status == 'ANDAMENTO')
                                            <div class="position-absolute top-0 end-0 rounded" style="height: 100%; width: 10%;background: linear-gradient(90deg, rgb(250, 249, 176) 9%, rgba(255,242,14,1) 58%, rgb(219, 223, 2) 100%);"></div>
                                        @else
                                            <div class="position-absolute top-0 end-0 rounded" style="height: 100%; width: 10%;background: linear-gradient(90deg, rgb(245, 177, 158) 9%, rgb(255, 106, 98) 53%, rgba(255,0,0,1) 100%);"></div>
                                        @endif
                                     <!-- FIM -->



                                <!-- PARTE DOS ICONES DE USER VINCULADOS A ATV -->
                                        <div class="row offset-3 col-8 d-flex " >
                                            <div class="d-flex flex-row-reverse"
                                            >

                                                @foreach ($atividade->usuarios as $usuario)
                                                <div class="row">
                                                    <i class="d-flex align-items-center justify-content-center  btn btn-primary bi bi-person-circle"  style="width: 2vh;
                                                    height:3vh"></i>
                                                       </div>
                                                @endforeach






                                            </div>
                                        </div>
                                        <div class="row offset-8 col-8 d-flex " >
                                        <button type="button" class="d-flex flex-row-reverse align-items-center justify-content-center  btn btn-success button_Assoc"
                                        style="width: 2vh;height:3vh"
                                        data-atividade='@json($atividade)'
                                        data-mdb-ripple-init
                                        data-mdb-modal-init
                                        data-mdb-target="#Modal_Associar_Usuario">
                                        <i class="mx-1 bi bi-person-plus-fill"></i>
                                        </button>
                                        </div>

                                    </div>

                                </div>

                            @endforeach
                            @endif

                        </div>

                    </div>
                </div>
                <button type="button" class="d-flex flex-row-reverse align-items-center justify-content-center btn btn-light border border-danger Delete_card_Button"
                style="width: 2vh;height:3vh"
                data-card="{{$card->idCard}}"
                data-obra="{{$idobra}}">
                <i class="fas fa-trash-can text-danger"></i>
            </button>

            </div>

        @endforeach




@else
<div class="card text-center container-fluid border border-dark">
    <div class="card-header">
      Lamento...
    </div>
    <div class="card-body">
      <h5 class="card-title">voce não tem cards</h5>
      <p class="card-text">crie um!</p>
      <div class="row">
      <i class="bi bi-emoji-smile-fill"></i>
    </div>

    </div>
    <div class="card-footer text-muted">



     <!-- BOTAO MODAL CARD -->
<button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#exampleModal">
  Criar novo card
 </button>
      </div>
    </div>

@endif

</div>

</div>
</div>
</div>
</div>












<!-- MODAL DE VINCULAR USUARIO A ATIVIDADE -->
<!-- Button trigger modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="Modal_Associar_Usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Associar Usuario</h5>
        <button type="button" class="btn-close" id="FecharAssociar" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center">
        <form id="Form_Assoc_User" method="PUT" style="width: 22rem; ">
          <!-- Name input -->
          <div class="row">
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" name="idUsuario" id="idUsuario" class="form-control" />
            <label class="form-label" for="form5Example1">Usuario id</label>
            <input type="hidden" name="idobra" value= '{{$idobra}}' />
            <input type="hidden" name="idAtividade" id="idAtividade" class="form-control" />
          </div>

        </div>

          <!-- Submit button -->
          <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Associar</button>
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>










<!-- MODAL DE CRIAR ATIViDADE -->
<div class="modal fade" id="ModalCriarAtividade" tabindex="-1" aria-labelledby="ModalCriarAtividadeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border border-warning" style="width: 70vw;">
      <div class="modal-header text-center  badge badge-warning">
        <h5 class="modal-title w-100" id="ModalCriarAtividadeLabel">Criar atividade</h5>
        <button type="button" class="btn-close" id="FecharCriarATV" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


<form enctype="multipart/form-data" class="col-8 offset-2 "  id="FormCriarAtv" action="{{route('Atividade.Criar')}}" method="POST">
  @csrf

  <div class="row mb-4">
    <div class="col-12">

<!-- ID input -->
<div data-mdb-input-init class="form-outline mb-4">

  <input name='card_atividades_idCard' type="hidden" class="form-control" id="card_atividades_idCard" readonly/>
  <input name='idobra' type="hidden" value= '{{$idobra}}' readonly/>
</div>



      <div data-mdb-input-init class="form-outline">
        <input placeholder="Placeholder" name='nome' type="text" class="form-control" />
        <label class="form-label" for="form6Example1">Nome da Atividade</label>
      </div>
    </div>
  </div>
<div class="row mb-4">
<div class="col">
  <!-- Text input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input name='dtInicial' type="date" class="form-control" />
    <label class="form-label" for="form6Example3">Data de Inicio</label>
  </div>
  </div>
  <div class="col">
  <!-- Text input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input name='dtFinal' type="date" class="form-control" />
    <label class="form-label" for="form6Example4">Data de Termino</label>
  </div>
</div>
</div>


  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <label class="input-group-text" >STATUS</label>
    </div>
    <select name="status" class="custom-select" id="inputGroupSelect01">
      <option selected value="COMEÇANDO" class=" text-success badge badge-success">INIÇIANDO</option>
      <option value="ANDAMENTO" class=" text-warning badge badge-warning">ANDAMENTO</option>
      <option value="FINALIZADO" class=" text-danger badge badge-danger">FINALIZADO</option>
    </select>
  </div>





  <!-- Message input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <textarea name='descricao' class="form-control" id="form6Example7" rows="4"></textarea>
    <label class="form-label" for="form6Example7">Descrição</label>
  </div>




<div class="row">
  <div class="mb-4 col-9">
    <label for="etiqueta" class="form-label">Etiqueta</label>
    <input type="file"  class="form-control " id="etiqueta" name="etiqueta[]" enctype="multipart/form-data" accept="image/*,.pdf" multiple>
    <!--<div id="etiquetaList"></div> -->
</div>
<div class="mb-4 col-9">
    <label for="anexo" class="form-label ">Anexo</label>
    <input type="file"  class="form-control  " id="anexo" name="anexo[]" enctype="multipart/form-data" accept="image/*,.pdf" multiple>
   <!-- <div id="anexoList"></div>-->
</div>
</div>


  <!-- Submit button -->
  <button type="submit"  class="btn btn-warning badge badge-warning btn-block mb-4">Criar Atividade</button>

</form>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>


















<!-- MODAL DE COMENTARIOS -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content" style="min-height: 70vh;">
      <div class="  text-center modal-header badge badge-primary " >

          <span name='titulo' class='display-6  text-center container-fluid'></span>

        <button type="button" id="FecharComent"  class="btn btn-light border border-danger text-danger" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
        </button>
      </div>




    <hr class="hr mt-4   "  />
<div class="d-flex">
      <div class="note note-danger mb-3 mx-4 w-50 ">
        <strong>Nota de Aviso:</strong> Por favor não proferir palavras de baixo calão e evitar comentario que
        não são voltados a atividade em questão
      </div>
      <div class="note note-warning mb-3 mx-4 w-50 ">
        <strong>Nota de Alerta:</strong> Esse chat é destinado a apenas comentarios relevantes a atividades, comente qualquer coisa que seja relevante a atividade
      </div>
    </div>
      <hr class="hr mt-4 bg" />




<!-- TESTANDO -->


<div class="d-flex  justify-content-center mt-3">
  <form id="formComentario" method="POST" style="width: 90%;margin-top:10vh;">
    @csrf


    <input type="hidden" name="Atividade_idAtividade" id="Atividade_idAtividade">
    <input type="hidden" name="Usuarios_idUsuario" id="Usuarios_idUsuario" >

    <div  style="display: flex; align-items: center;">
      <input class="form-control " id="comentario" name="comentario" placeholder="Digitar Comentario" style="border-bottom: 1px solid #000; border-left: none; border-right: none; border-top: none; width: 40vw;">
       <button type="submit" class="bg bg-white " style="position:absolute; left:48%;border: none;"><i class="fas fa-paper-plane text-primary"></i></button>
    </div>

  </form>
  </div>

<table class="table align-middle mb-0 bg-white ">

  <tbody id="comentarios">
       <!-- Aqui serão exibidos os comentários -->
  </tbody>
</table>
  </div>
</div>
</div>












  <!-- MODAL DE VER E EDITAR ATIVIDADE-->
<div class="modal fade" id="staticBackdrop" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header badge badge-warning border-bottom">
          <img class="card-img-top " name="etiqueta[]" id="etiqueta[]" src="" alt="Card image cap" style="max-height: 30vh; min-height: 30vh;">
        </div>

        <form class="modal-body" id="atividadeForm" enctype="multipart/form-data" method="POST">
          @csrf
          @method('PUT')
        <input name='idobra' type="hidden" value= '{{$idobra}}' readonly/>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="idAtividade" readonly/>
  <input name='card_atividades_idCardV' type="hidden" readonly/>




        <div class="row">

 <!-- MEMBROS -->
 <!-- MEMBROS BUT -->
 <div class="a-fle justify-content-center  mb-3">
  <a
  class="btn btn-warning"
  data-mdb-collapse-init
  data-mdb-ripple-init
  href="#collapseWithScrollbar"
  role="button"
  aria-expanded="false"
  aria-controls="collapseExample"
  >
  Membros
  </a>
  </div>



  <!-- MEMBROS CORPO -->
  <div class="collapse mt-3 scroll-section" id="collapseWithScrollbar"  >
  <!-- MEMBROS CARD -->
    <div class="row">
  <div name="nomeUsuario"></div>
      </div>
  </div>


        <div class="mb-3 col-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" name="statusV">
            <option class="list-group-item-primary "  value="COMEÇANDO">COMEÇANDO</option>
            <option class="list-group-item-warning "  value="ANDAMENTO">ANDAMENTO</option>
            <option class="list-group-item-danger "   value="FINALIZADO">FINALIZADO</option>
          </select>
        </div>

      </div>



            <div class="mb-3">
              <label for="nome" class="form-label">Atividade</label>
              <input type="text" class="form-control  " name="nomeV">
            </div>
              <div class="row">
            <div class="mb-3 col-6">
                <label for="dtFinal" class="form-label">Data de Término</label>
                <input type="date" class="form-control " name="dtFinalV">
              </div>
              <div class="mb-3 col-6">
                <label for="dtInicial" class="form-label">Data de Início</label>
                <input type="date" class="form-control " name="dtInicialV">
              </div>
            </div>






<div class="row">
  <div class="mb-3 col-6">
    <label for="etiqueta" class="form-label">Etiqueta</label>
    <input type="file"  class="form-control border border-warning" id="etiquetaV" name="etiqueta[]" enctype="multipart/form-data" accept="image/*,.pdf" multiple>
    <!--<div id="etiquetaList"></div> -->
</div>
<div class="mb-3 col-6">
    <label for="anexo" class="form-label ">Anexo</label>
    <input type="file"  class="form-control  border border-warning" id="anexoV" name="anexo[]" enctype="multipart/form-data" accept="image/*,.pdf" multiple>
   <!-- <div id="anexoList"></div>-->
</div>
</div>

<div class="mb-3">
  <label for="descricao" class="form-label">Descrição</label>
  <textarea class="form-control " name="descricaoV" rows="3"></textarea>
</div>





           <div class="mb-3">
                <button id="atualizarAtividadeBtn" type="submit" class="btn btn-success">Atualizar</button>
                <button type="button" class="btn btn-danger" id="btnDeletarAtividade">Deletar</button>
            </div>
          </form>


          <!-- Adicione aqui os outros campos do seu formulário -->

          <div class="d-flex justify-content-end">
            <button type="button" id="FecharView" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
          </div>

        </form>
      </div>
    </div>
  </div>







  <!-- MODAL DE CRIAR CARD-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="col s12" action="{{ route('Card.Criar') }}" method="POST">
        @MEthod('POST')
        @csrf
        <input name='Obras_idObras' type="hidden" class="form-control"  value= '{{$idobra}}' readonly class="form-control"/>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Titulo do card:</h5>
      </div>
      <div class="modal-body">



          <div class="form-group">
              <label>titulo</label>
              <input type="text" class="form-control"   placeholder="inserir titulo" name="titulo">

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="FecharCreateCard" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>

</div>





</main>

<!-- SCRIPTS DE THAUAN -->


<script type="module"  src="{{ secure_asset('js/app.js') }}"></script>




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
