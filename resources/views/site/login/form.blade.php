<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ secure_asset('img\capacete.png') }}">
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
    <title>Login</title>
</head>
<body>
    
   


 



<div
class="bg-image"
style="
background-image: url('img/Login_BG.jpg');

 
"
>

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



<div class="col-12 container-fluid d-flex align-items-center justify-content-center  vh-100">



<div class="card mb-3 p-2 border border-warning"  style="min-height: 50vh;max-height: 70vh; min-width:50vw;">
    <div class="row g-0">
        <div class="col-md-4 d-flex  flex-column align-items-center borber border-danger">

        <div class="row mt-4">
            <img src="{{ secure_asset('img/capacete.png') }}" alt="Capacete"

            class="img-fluid" style="max-width:100%;max-height:10vh;">
        </div>
        <div class="row mt-4 text-center">
<p class="text-warning fst-italic fw-bold">CONSTRU <i class="fas fa-helmet-safety"></i><p class="text-primary fst-italic fw-bold">ADMIN <i class="fas fa-business-time"></i></p> </p>
        </div>


        </div>
      <div class="col-md-8">
        <div class="card-body">
        
            <div class="row mt-4" style="position: static;">
                <form action="{{route('login.auth')}}" method="POST">
                    @csrf
                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input  type="email" name="Email" id="form2Example1" class="form-control" required/>
                      <label class="form-label" for="form2Example1">Email address</label>
                    </div>
                  
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" name="password" id="form2Example2" class="form-control" required/>
                      <label class="form-label" for="form2Example2">Password</label>
                    </div>
                  
                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                      <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember"value="" id="form2Example34" checked />
                          <label class="form-check-label" for="form2Example34"> Remember me </label>
                        </div>
                      </div>
                  
                      <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                      </div>
                    </div>
                  
                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" class="btn btn-warning btn-block mb-4">Sign in</button>
                  
                    <!-- Register buttons -->
                    <div class="text-center">
              
                      <button  data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                      </button>
                  
                      <button  data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-google"></i>
                      </button>
                  
                      <button  data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                      </button>
                  
                      <button  data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-github"></i>
                      </button>
                    </div>
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