<?php
include_once './config/Config.php';
include_once './backend/Usuario.php';
include_once './backend/Feedback.php';
include_once './backend/Database.php';

session_start();
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
$idUsu = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null; // Verifica se 'usuario_id' está definido

try {
    $db = new PDO("mysql:host=localhost;dbname=kcsdb;charset=utf8", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit;
}

$feedback = new Feedback($db);
$dados_feedback = $feedback->lerFeed();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>King Can't Scape!</title>
</head>


<body>
    <?php include_once "header.php"; ?>

    <main class="container">
        <section class="hero">
            <div class="hero-content">
                <div class="hero-logo">
                    <div class="hero-text-1">
                        <p class="hero-text-left">Faça parte</p>
                    </div>
                    <div class="hero-img">
                        <img src="cabeca.png" alt="Logo do reizinho" class="site-logo">
                    </div>
                    <div class="hero-text-2">
                        <p class="hero-text-right">da aventura</p>
                    </div>
                </div>

                <a href="#about-game" class="btn-scroll">Saiba mais</a>
            </div>
        </section>
    </main>
    <section id="about-game" class="about-game">
        <div class="about-game-content">
            <div class="about-game-text">
                <h2>Sobre o Jogo</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget lorem in urna mattis aliquet.</p>
                <a href="baixar.php" class="btn-download">Baixar</a>
            </div>
            <div class="game-image-container">
                <img src="fundo.jpeg" alt="Imagem do jogo" class="game-image">
                <div class="diagonal-line"></div>
            </div>
        </div>
    </section>
    <div id="feedbacks" class="feedbacks">
        <div class="feedbacks-titulo">
            <h1>Feedbacks</h1>
            <p>Publique seu feedback sobre o nosso primeiro jogo feito em 15 dias!</p>
        </div>

        <?php if ($logged_in) : ?>
            <div class="feedback-publicar">
                <form method="POST" action="processar_feedback.php">
                    <label for="conteudo">Escreva o feedback:</label><br>
                    <textarea name="conteudo" cols="70" rows="5"></textarea><br>

                    <!-- Campo oculto para armazenar o idUsu -->
                    <input type="hidden" name="idUsu" value="<?php echo $idUsu; ?>">

                    <div class="enviar">
                        <input type="submit" class="input_enviar" value="Enviar">
                    </div>
                </form>
            </div><br><br>
        <?php else : ?>
            <p>Você precisa estar logado para enviar um feedback.</p>
        <?php endif; ?>


        <div class="feedbacks-publicados">
            <?php while ($row = $dados_feedback->fetch(PDO::FETCH_ASSOC)) : ?>
                <table class="table" border="1">
                    <td><?php echo $row['nickname']; ?></td>
                    <td><?php echo $row['data']; ?></td>
                </table>
                <table class="table-2" border="1">
                    <tr>
                        <td><?php echo $row['feedback']; ?></td>
                    </tr>
                </table><br><br>
            <?php endwhile; ?>

        </div>
    </div>

    <?php include_once "footer.php"; ?>
</body>

</html>