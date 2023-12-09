<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{--CSS--}}
    <link rel="stylesheet" href="{{url("css/layoutFora.css")}}">
    {{--boostrap--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{--Font awesome Icon--}}
    <script src="https://kit.fontawesome.com/3117251fc7.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Area de teste2</title>
</head>
<body>
   {{--Header/Navbar--}}
    <nav class="navbar navbar-expand px-3 border-bottom navbar-main">

        {{--Botão toogle--}}
        <button class="btn btn-toggle" id="sidebar-toggle" .type='button' style="font-size: 1.2rem;">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{--Fim do Botão toogle--}}

        {{--Espaçamento--}}
        <div class="spacer" style="width: 20px;"></div>

        <!-- Logo da empresa -->
        <div class="navbar-brand d-flex align-items-center">
            <img src="{{url("img/capacete.png")}}" alt="Logo da Empresa" width="60" height="60" class="d-none d-md-block">
            <span class="company-name ms-2 company-name-mobile">ConstruAdmin</span>
            <span class="separator d-none d-md-block">|</span>
            <span class="portal-name ms-2 d-none d-md-block" style="color: white;">Portal da Empresa</span>
        </div>
        {{--Fim da logo da empresa--}}

        {{--Parte final do Navbar/header--}}
        <div class="navbar-collapse navbar">
            <ul class="navbar-nav">
                {{--Icone de Ajuda--}}
                <i class="fa-regular fa-circle-question imagem-no-navbar">
                    <a href="#"></a>
                </i>
                {{--Icone de Notificação--}}
                <i class="fa-solid fa-bell imagem-no-navbar">
                    <a href="#"></a>
                </i>
                {{--Avatar de Usuario--}}
                <li class="nav-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0 d-flex align-items-center">
                        {{--Imagem do Usuario--}}
                        <img src="{{url("img/avatar.png")}}" class="avatar img-fluid rounded " alt="">
                        {{--Nome do usuario--}}
                        <span class="company-name ms-2 d-none d-md-block">Diego</span>
                    </a>
                        {{--Menu do usuario--}}
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Setting</a>
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
     {{--Fim do Header/Navbar--}}


    <div class="wrapper">
        {{--conteudo da sidebar--}}
        <aside id="sidebar">
            <ul class="sidebar-nav">
                {{--Dashboard Icone--}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link first-item" onclick="highlightItem(this)">
                        <i class="fa-solid fa-building"></i>
                        <span>Obras</span>
                    </a>
                </li>
                {{--Page Icone--}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="highlightItem(this)">
                        <i class="fa-solid fa-users"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
                {{--Post Icone--}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="highlightItem(this)">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span>Estoque</span>
                    </a>
                </li>
                {{--Auth Icone--}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="highlightItem(this)">
                        <i class="fa-regular fa-file-lines"></i>
                        <span>Relatorios</span>
                    </a>
                </li>
                {{--Multi Icone--}}
                <li class="sidebar-item invisible">
                    <a href="#" class="sidebar-link" onclick="highlightItem(this)">
                        <i class="fa-solid fa-share-nodes"></i>
                        <span>Multi Dropdown</span>
                    </a>
                </li>
            </ul>
        </aside>
         {{--Fim da sidebar--}}

        <div class="main">
            {{--Conteudo--}}
           @yield('conteudo')
        </div>
    </div>
    <script src="{{url("js/script.js")}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
