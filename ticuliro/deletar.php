<?php
    session_start();
    if(!isset($_SESSION['usuario_id'])){
        header('Location: login.php');
        exit();
    }

    include_once './config/Config.php';
    include_once './backend/Usuario.php';
    include_once './backend/Feedback.php';

    $usuario = new Usuario($db);
    $feedback = new Feedback($db);

    if(isset($_SESSION['usuario_id'])){
        $id = $_GET['usuario_id'];
        $feedback->deletarFeed($idfeed);
        $usuario->deletar($id);
        header('Location: index.php');
        exit();
    }
?>