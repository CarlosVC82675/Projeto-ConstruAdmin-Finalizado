<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{secure_asset('css/layoutDentro.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/layoutFora.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!--icones do guia do site-->
    <link rel="icon" href="{{ secure_asset('img/capacete.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ secure_asset('img/capacete.ico') }}" type="image/x-icon">
    <script src="https://kit.fontawesome.com/3117251fc7.js" crossorigin="anonymous"></script>
</head>
<body>

  <nav class="navbar navbar-expand px-3 border-bottom navbar-main" style="border-bottom: var(--bs-border-width) var(--bs-border-style) #00000000!important;">


    <div class="spacer" style="width: 20px;"></div>


    <!-- Logo da empresa -->
    <div class="navbar-brand d-flex align-items-center">
        <a href="{{route('site.index')}}"> <img src="{{secure_asset("img/capacete.png")}}" alt="Logo da Empresa" width="60" height="60" class="d-none d-md-block"></a>
        <a href="{{route('site.index')}}"><span class="company-name ms-2 company-name-mobile">ConstruAdmin</span></a>
        <span class="separator d-none d-md-block">|</span>
        <span class="portal-name ms-2 d-none d-md-block">{{$obra->nome}}</span>
    </div>

    <div class="navbar-collapse navbar">
        <ul class="navbar-nav">
            <i class="fa-regular fa-circle-question imagem-no-navbar">
                <a href="#"></a>
            </i>
            <i class="fa-solid fa-bell imagem-no-navbar">
                <a href="#"></a>
            </i>
            <li class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0 d-flex align-items-center">
                    {{--Imagem do Usuario--}}
                    <img src="{{secure_asset("img/avatar.png")}}" class="avatar img-fluid rounded " alt="">
                    {{--Nome do usuario--}}
                    <span class="company-name ms-2 d-none d-md-block">
                        @if (Auth::check())
                            {{ Auth::user()->name }}
                        @else
                            Anônimo
                        @endif
                    </span>
                </a>
                    {{--Menu do usuario--}}
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Setting</a>
                    <a href="{{route('login.logout')}}"  class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>


    <nav class="navbar navbar-expand-md navbar-dark" id="cor" aria-label="Fourth navbar example">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="navbar-collapse collapse " id="navbarsExample04" style="">
            <ul class="navbar-nav me-auto mb-2 mb-md-0" id="tapa">

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('obra.dashboard', ['id' => $obra->idObras]) }}"">Dashboard</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Projetos</a>
                <ul class="dropdown-menu" id="dropdentro">
                    <li><a class="dropdown-item-dentro" href="{{ route('obra.foto', ['id' => $obra->idObras]) }}">Fotos</a></li>
                  <li><a class="dropdown-item-dentro" href="{{route('obra.arquivo', ['id' => $obra->idObras]) }}">Arquivos</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{route('obra.materiais', ['id' => $obra->idObras]) }}">Materiais</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Relatórios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{route('Atividade.Kanban', ['id' => $obra->idObras]) }}">Atividades</a>
              </li>


            </ul>

          </div>
        </div>
      </nav>

        {{--Mensagens--}}
        @if (session('success'))
        <div class="card">
            <h5 class="card-header">Sucesso!!</h5>
            <div class="card-body">
            <p>{{ session('success') }}</p>
        </div>
        </div>
        @endif

        @if(session('error') && session('confirm'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if(session('error') && isset(session('error')['code']))
        <div class="alert alert-danger">
        <strong>{{ session('error')['message'] }}</strong> - Código: {{ session('error')['code'] }}
        </div>
        @endif
        {{--Fim das Mensagens--}}


    @yield('conteudo')






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
