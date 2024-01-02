<!DOCTYPE html>
<html>
<head>
    <title>Bem-vindo ao ConstruAdmin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        p {
        color: #666;
        font-size: 16px; /* Tamanho da fonte ajustado para 16px */
        /* Outros estilos */
        }
        li{
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo ao ConstruAdmin</h1>
        <p>Prezado(a) {{$nome}},</p>
        <p>Você acaba de ser registrado em nosso sistema.</p>
        <p>Aqui estão suas credenciais para fazer o primeiro acesso:</p>
        <ul>
            <li><strong>Email:</strong> {{ $email }}</li>
            <li><strong>Senha:</strong> {{ $senha }}</li>
        </ul>
        <p>Visite nosso site: <a href="https://tcc-senai-production.up.railway.app/">ConstruAdmin</a>.</p>
        <p>Por favor, faça seu primeiro login utilizando essas credenciais. Você será direcionado posteriormente para redefinir sua senha.</p>
        <p>Obrigado por se juntar à nossa plataforma.</p>
        <p>Atenciosamente,<br>Equipe ConstruAdmin</p>
    </div>
</body>
</html>
