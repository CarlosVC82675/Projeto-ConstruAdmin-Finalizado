<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url("css/app.css")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

    <div class="navbar-c">
        <a href="#">
        <img src="{{url("img/capacete.png")}}" alt="" class="img-icone">
         </a>
        <p class="logan">ConstruAdmin</p>
        <div class="obra">
        <p>Obra {{$obra->nome}}</p>
         </div>
        <img src="{{url("img/sino.png")}}" alt="" class="img-sino">
        <p class="atribuicao">Supervisor</p>
        <img src="{{url("img/avatar-de-perfil.png")}}" alt="" class="img-avatar">
        <a href="" class="link-sair">SAIR</a>
    </div>
    <div class="navbar-b">
        <a href="#" class="link">Dashboard</a>
        <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" id="Tome" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Projeto
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Fotos</a></li>
              <li><a class="dropdown-item" href="#">Arquivos</a></li>
            </ul>
          </div>
        <a href="" class="link">Materiais</a>
        <a href="" class="link">Relatórios</a>
        <a href="" class="link">Atividades</a>
    </div>





   
    @yield('conteudo')
   




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>