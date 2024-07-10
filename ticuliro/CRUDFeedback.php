<?php
session_start();
include_once './config/Config.php';
include_once './backend/Feedback.php';
include_once './backend/Usuario.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$feedback = new Feedback($db);
$usuario = new Usuario($db);

// Processar exclusão de notícias
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $feedback->deletarFeed($id);
    header('Location: CRUDFeedback.php');
    exit();
}

// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$idUsu = $dados_usuario['id'];
$nome_usuario = $dados_usuario['nome'];


// Obter dados das noticias do usuário logado
$dados_feedback = $feedback->lerPorId($idUsu);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <main>
        <table">
            <div>
                <a href="AddFeedback.php"><button>Adicionar feedback</button></a>
            </div><br><br>
            <thead>
                <tr>
                    <th>
                        <h1>Feedback</h1>
                    </th>
                    <th>
                        <h1>data</h1>
                    </th>
                    <th>
                        <h1>Ações</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $dados_feedback->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row['idfed']; ?></td>
                        <td><?php echo $row['titulo']; ?></td>
                        <td><?php echo $row['data']; ?></td>
                        <td>
                            <a href="editarFeedback.php?idfed=<?php echo $row['idfed']; ?>">Editar</a> &nbsp;&nbsp;
                            <a href="deletar.php?idfed=<?php echo $row['idfed']; ?>">Deletar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </main>
    <?php include_once 'footer.php'; ?>
</body>

</html>