<?php
session_start();
include_once './config/Config.php';
include_once './backend/Usuario.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario = new Usuario($db);

// Processar exclusão de usuário
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $usuario->deletar($id);
    header('Location: CRUDUsuario.php');
    exit();
}

// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);

$nome_usuario = $dados_usuario['nome'];
$nickname_usuario = $dados_usuario['nickname'];
$dataNasc_usuario = $dados_usuario['dataNasc'];
$email_usuario = $dados_usuario['email'];

// Função para determinar a saudação
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Usuario</title>
</head>

<body>
    <?php include_once 'header.php'; ?>

    <main>
        <table>
            <div >
                <div >
                    <div>
                        <h2>Perfil</h2>
                    </div>
                </div>
                <div >
                    <form>
                        <div>
                            <label><strong>Nome:</strong></label>
                            <label><?php echo $nome_usuario ?></label>
                        </div><br><br>
                        <div>
                            <label><strong>nickname:</strong></label>
                            <label><?php echo $nickname_usuario ?></label>
                        </div><br><br>
                        <div >
                        <div>
                            <label><strong>Data de nascimento:</strong></label>
                            <label><?php echo $dataNasc_usuario ?></label>
                        </div><br><br>
                        <div >
                            <label><strong>E-mail:</strong></label>
                            <label><?php echo $email_usuario ?></label>
                        </div><br><br>
                    </form>
                    <a href="editar.php"><button>Editar</button></a>
                </div>
            </div>
        </table><br><br>

    </main>

    <?php include_once 'footer.php'; ?>

</body>

</html>