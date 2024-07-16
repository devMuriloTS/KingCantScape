<?php
    session_start();
    include_once './config/Config.php';
    include_once './backend/Usuario.php';

    $usuario = new Usuario($db);

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['login'])){
            // Processar login
            $nickname = $_POST['nickname'];
            $senha = $_POST['senha'];
            if($dados_usuario = $usuario->login($nickname, $senha)){
                $_SESSION['logged_in'] = true;
                $_SESSION['nickname'] = $nickname;
                $_SESSION['usuario_id'] = $dados_usuario['id'];
                header('Location: index.php');
                exit();
                
            }else{
                $mensagem_erro = "Credenciais inválidas!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelogin.css">
    <title>Login</title>
</head>

<body>
    <?php include_once "header.php"; ?>

    <div class="seila">
        <form method="POST">
            <p>Autenticação</p>
            <label>Nickname</label>
            <input type="text" name="nickname" required/>
            <label>Senha</label>
            <input type="password" name="senha" required />
            
            <button type="submit" name="login">Login</button>
        </form>
        <div class="mensagem">
            <?php
            if (isset($mensagem_erro)) {
                echo '<p>' . $mensagem_erro . '</p>';
            }
            ?>
        </div>
        <a href="./registrar.php">Registrar-se</a>
        <a href="./solicitar_recuperacao.php">Recuperar senha</a>
    </div>
</body>
</html>
