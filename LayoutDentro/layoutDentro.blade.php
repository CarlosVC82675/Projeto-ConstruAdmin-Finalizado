<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('css/layoutDentro.css')}}">
    <link rel="stylesheet" href="{{url('css/layoutFora.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/3117251fc7.js" crossorigin="anonymous"></script>
</head>
<body>

  <nav class="navbar navbar-expand px-3 border-bottom navbar-main">
   

    <div class="spacer" style="width: 20px;"></div>


    <!-- Logo da empresa -->
    <div class="navbar-brand d-flex align-items-center">
        <img src="{{url("img/capacete.png")}}" alt="Logo da Empresa" width="60" height="60" class="d-none d-md-block">
        <span class="company-name ms-2 company-name-mobile">ConstruAdmin</span>
        <span class="separator d-none d-md-block">|</span>
        <span class="portal-name ms-2 d-none d-md-block">ObraTeste</span>
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
                    <img src="{{url("img/avatar.png")}}" class="avatar img-fluid rounded " alt="">
                    <span class="company-name ms-2 d-none d-md-block">Diego</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Setting</a>
                    <a href="#" class="dropdown-item">Logout</a>
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
                <a class="nav-link active" aria-current="page" href="">Dashboard</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Projetos</a>
                <ul class="dropdown-menu" id="dropdentro">
                  <li><a class="dropdown-item-dentro" href="">Fotos</a></li>
                  <li><a class="dropdown-item-dentro" href="">Arquivos</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Materiais</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Relatórios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Atividades</a>
              </li>
              
            
            </ul>
            
          </div>
        </div>
      </nav>

   
    @yield('conteudo')
   

   


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>