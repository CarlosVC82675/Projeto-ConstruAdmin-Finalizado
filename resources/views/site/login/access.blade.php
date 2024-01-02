<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ secure_asset('img\capacete.png') }}">
    <!--icones do guia do site-->
    <link rel="icon" href="{{ secure_asset('img/capacete.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ secure_asset('img/capacete.ico') }}" type="image/x-icon">
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
href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css"
rel="stylesheet"
/>
    <title>ConstruAdmin/Redefinir Senha</title>
</head>
<body>

    <div class="bg-image" style="background-image: url('{{ secure_asset('img/Login_BG.jpg') }}');">

        <div class="container-fluid " style="position: absolute;">
                @if ($mensagem = Session::get('erro'))
                <div class="alert alert-light" role="alert">
                    {{ $mensagem }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-light" role="alert">
                    <strong>Erro:</strong> Por favor, corrija os seguintes erros:
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
            <div class="card border border-warning" style="min-height: 50vh; max-height: 70vh; min-width: 50vw;">
                <div class="row g-0">
                    <div class="col-md-4 d-flex flex-column align-items-center">
                        <div class="row mt-4">
                            <img src="{{ secure_asset('img/capacete.png') }}" alt="Capacete" class="img-fluid" style="max-width:100%; max-height:10vh;">
                        </div>
                        <div class="row mt-4 text-center">
                            <p class="text-warning fst-italic fw-bold">CONSTRU <i class="fas fa-helmet-safety"></i></p>
                            <p class="text-primary fst-italic fw-bold">ADMIN <i class="fas fa-business-time"></i></p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="row mt-4">
                                <form action="{{ route('usuarios.redefinirSenha') }}" method="POST">
                                    @csrf
                                    <p style="font-family: 'Poppins', sans-serif;">
                                        Para finalizar o processo de autenticação, defina uma nova senha.<br>
                                        <strong>Essa senha será usada nos seus próximos acessos. Anote!</strong>
                                    </p>
                                    <div class="mb-3">
                                        <label class="form-label">Nova Senha</label>
                                        <input type="password" class="form-control" name="novaSenha" placeholder="Deve conter no minino 10 digitos e 1 letra" required minlength="8">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirme a Nova Senha</label>
                                        <input type="password" class="form-control" name="confirmacaoSenha" placeholder="Deve conter no minino 10 digitos e 1 letra" required minlength="8">
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-warning btn-block mt-4">Redefinir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"
></script>

</body>
</html>
