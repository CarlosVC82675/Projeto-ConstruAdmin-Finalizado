<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url("css/app.css")}}">
    <link rel="stylesheet" href="{{url("css/dashboardDentro.css")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body>

    <nav class="navbar navbar-expand">

        <div class="d-flex" id="logo">
             <img src="{{url('img/capacete.png')}}" class="icone" alt="">
             <a class="navbar-brand d-none d-md-block" href="#">ConstruAdmin</a>
         </div>

         <div class="w-50" id="nome">
             <a class="text-break text-decoration-none text-black ">Obra Dendezeiros</a>
         </div>

         <div class="d-flex justify-content-evenly" id="canto">
             <img src="{{url('img/sino.png')}}" class="sino img-fluid rounded "  alt="">

         <div class="w-50" id="nome">
             <a class="text-decoration-none text-black d-none d-md-block ">Supervisor</a>
         </div>
             <img src="{{url("img/avatar-de-perfil.png")}}" alt="" class="avatar img-fluid rounded">
             <a href="" class="btn btn-danger">SAIR</a>
         </div>


   </nav>


 <nav class="navbar navbar-expand-md navbar-dark bg-warning" aria-label="Fourth navbar example">
     <div class="container-fluid">
       <a class="navbar-brand" href="#"></a>
       <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>

       <div class="navbar-collapse collapse " id="navbarsExample04" style="">
         <ul class="navbar-nav me-auto mb-2 mb-md-0" id="tapa">

           <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
           </li>
           <li class="nav-item dropdown">
             <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Projetos</a>
             <ul class="dropdown-menu">
               <li><a class="dropdown-item" href="#">Fotos</a></li>
               <li><a class="dropdown-item" href="#">Arquivos</a></li>
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
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</body>
</html>
