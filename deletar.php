<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

include_once './config/Config.php';
include_once './backend/Usuario.php';
include_once './backend/Feedback.php'; // Se necessário, ajuste o caminho correto

$usuario = new Usuario($db);
$feedback = new Feedback($db);

if (isset($_GET['usuario_id'])) {
    $id = $_GET['usuario_id'];
    // Supondo que $id seja o id do usuário a ser deletado
    $usuario->deletar($id);

    // Redirecionamento para a página inicial ou outra página após a exclusão
    header('Location: index.php');
    exit();
} else {
    // Caso $_GET['usuario_id'] não esteja definido, tratar adequadamente ou redirecionar para outra página de erro
    header('Location: index.php');
    exit();
}
?>
