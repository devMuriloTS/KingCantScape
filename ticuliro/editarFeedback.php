<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

include_once './config/Config.php';
include_once './backend/Usuario.php';
include_once './backend/Feedback.php';

$usuario = new Usuario($db);
$feedback = new Feedback($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
    $idUsu = $dados_usuario['id'];

    $data = $_POST['data'];
    $feedbacks = $_POST['feedback'];

    $noticia->atualizar($idUsu, $data, $feedback);
    header('Location: CRUDFeedback.php');
    exit();
}

if (isset($_GET['id'])) {
    $idNot = $_GET['idnot'];
    $row = $feedback->lerPorId($idNot);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="styleCRUD.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Notícia</title>
</head>

<body>
    <header>
        <h1>Newsphere</h1>
        <label class="switch">
            <input type="checkbox" onchange="myFunction()">
            <span class="slider"></span>
        </label>
    </header>
    <main class="main_editar">
        <div class="card">
            <div class="card-header">
                <div class="text-header">
                    <h2>Editar Notícia</h2>
                </div>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input required class="form-control" name="titulo" id="titulo" type="text">
                    </div>

                    <div class="form-group">
                        <label for="noticia">Notícia:</label>
                        <textarea cols="38" class="form-control" rows="20" required name="noticia" id="noticia"></textarea>
                    </div>

                    <input type="submit" name="login" class="btn" value="Adicionar"><br><br>
                </form>
                <a href="CRUDUsuario.php"><button class="btn" style="margin-left: 33%;">Voltar</button><br><br></a>
            </div>
        </div>
    </main>
    <script>
        function myFunction() {
            var element = document.body;
            element.classList.toggle("dark-mode");
        }
    </script>
</body>

</html>