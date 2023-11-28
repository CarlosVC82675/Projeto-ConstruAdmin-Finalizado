@if ($mensagem = Session::get('erro'))
{{$mensagem}}
@endif

{{--validate guarda erros na variavel erros--}}
@if ($errors->any())
{{--se haver algum erro ele vai pecorrer os erros--}}
    @foreach ($errors->all() as $error )
        {{$error}}<br>
    @endforeach
@endif



<form action="{{route('login.auth')}}" method="POST">
@csrf
Email: <br> <input type="email" name="Email"><br>
Senha: <br> <input type="password" name="password"> <br>
<input type="checkbox" name="remember">Lembrar-me


<button type="submit"> Entrar </button>
</form>
