<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    session_start();
    $logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];

    if (!$logged_in) {
        header("Location: login.php"); 
        exit;
    }
    
    include_once './config/Config.php'; 
    include_once './backend/Feedback.php';
    
    $conteudo = $_POST['conteudo'];
    $idUsu = $_POST['idUsu'];
    
    // Criar uma instância da classe Database para obter a conexão
    $database = new Database();
    $db = $database->getConnection();
    
    // Cria uma instância da classe Feedback
    $feedback = new Feedback($db);
    
    // Insere o feedback no banco de dados
    $inserido = $feedback->inserirFeedback($conteudo, $idUsu);
    
    if ($inserido) {
        header("Location: index.php");
        exit;
    } else {
        echo "Ocorreu um erro ao processar seu feedback. Por favor, tente novamente mais tarde.";
    }
    
} else {
    // Se o método da requisição não for POST, redireciona para alguma página de erro
    header("Location: index.php"); // Substitua 'error.php' pela página de erro apropriada
    exit;
}
?>
