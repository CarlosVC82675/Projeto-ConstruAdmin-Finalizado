<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--CSS Bootstrap--}}
    <link rel="stylesheet" href="{{url("css/layoutFora.css")}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Area de Trabalho</title>
</head>
<body>

    {{--HEADER--}}
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <ul class="list-unstyled d-flex align-items-left w-100"  style="gap: 10px;">
            <li><h4><i class="bi bi-hammer"></i></h4></li>
            <li class="navbar-brand">ConstruAdmin</li>
            <li><h4><i class="bi bi-person-lines-fill"></i></h4></li>
            <li class="navbar-brand">Portal da Empresa</li>
        </ul>
        <ul class="list-unstyled d-flex align-items-right w-100"  style="gap: 10px;">
            <li><button type="button" class="btn btn-dark"> <i class="bi bi-question-diamond-fill"></i> Ajuda</button></li>
            <li><h4><i class="bi bi-bell-fill"></i></h4></li>
        </ul>
    </nav>
    {{--FIM DO HEADER--}}

     {{--BARRA LATERAL--}}
    <div class="d-flex flex-column flex-shrink-0 bg-warning fixed-top h-100" style="width: 4.5rem; margin-top: 70px;">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center ">
          <li class="nav-item">
            <a href="#" class="nav-link active py-3 border-bottom bg-warning" aria-current="page" title="Início" data-bs-toggle="tooltip" data-bs-placement="right">
                <h4><i class="bi bi-house-door-fill text-dark"></i></h4>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link active py-3 border-bottom bg-warning" aria-current="page" title="Obras" data-bs-toggle="tooltip" data-bs-placement="right">
              <h4><i class="bi bi-building-fill-gear text-dark"></i></h4>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link active py-3 border-bottom bg-warning" aria-current="page" title="Usuários" data-bs-toggle="tooltip" data-bs-placement="right">
              <h4><i class="bi bi-people-fill text-dark"></i></h4>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link active py-3 border-bottom bg-warning" aria-current="page" title="Estoque" data-bs-toggle="tooltip" data-bs-placement="right">
              <h4><i class="bi bi-boxes text-dark"></i></h4>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link active py-3 border-bottom bg-warning" aria-current="page" title="Etc" data-bs-toggle="tooltip" data-bs-placement="right">
              <h4><i class="bi bi-sliders text-dark"></i></h4>
            </a>
          </li>
        </ul>
    </div>
    {{--FIM DA BARRA LATERAL--}}




    {{--PEGA ERROS DE VALIDAÇÃO--}}
    @if ($errors->any())
        <div class="card mb-3">
            <h5 class="card-header">Erro</h5>
            <div class="card-body">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    </div>
    @endif


    {{--PEGA MESANGES DE SUCESSO--}}
    @if (session('success'))
        <div class="card mb-3">
            <h5 class="card-header">Sucesso!!</h5>
            <div class="card-body">
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif



    {{--PEGA MESANGES DE ERRO--}}
   @if (session('erro'))
   <div class="alert alert-danger">
       {{ session('erro') }}
   </div>
@endif



{{--AREA DE TRABALHAR, E AQUI QUE VC PODE COMEÇAR--}}
    @yield('conteudo')
















{{--SCRIPT DO BOOTSTRAP--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>




</body>
</html>
