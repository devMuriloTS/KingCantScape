<?php
include_once './config/Config.php';
include_once './backend/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($db);
    $nickname = $_POST['nickname'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $dataNasc = $_POST['dataNasc'];
    $usuario->criar($nickname, $nome, $email, $senha, $dataNasc);
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="loginstyle.css" />
    <title>Registre-se</title>
</head>

<body>
    <div class="container">
    <form method="POST" class="registro">
        <p> Registro </p>
        <label for="nickname">Nickname</label>
        <input type="text" name="nickname" required maxlength="16">

        <label for="nome">Nome</label>
        <input type="text" name="nome" required maxlength="100"> 

        <label for="email">Email</label>
        <input type="email" name="email" required maxlength="255"> 

        <label for="senha">Senha</label>
        <input type="password" name="senha" required maxlength="255">

        <label for="dataNasc">Ano de Nascimento</label>
        <input type="date" name="dataNasc" required maxlength="4" placeholder="2000">



        <button type="submit">Registrar</button>
    </form>
    <a class="voltar" href="./login.php"><button class="voltarbt">Voltar</button></a>
    </div>
</body>

</html>