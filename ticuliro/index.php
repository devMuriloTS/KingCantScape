<?php include_once "header.php";
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];

include_once './backend/Usuario.php';
include_once './backend/Feedback.php';

$feedback = new Feedback($db);

$dados_feedback = $feedback->lerFeed($search, $order_by);


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

    <main class="container">
        <section class="hero">
            <div class="hero-content">
                <div class="hero-text">
                    <p class="hero-text-left">Faça parte</p>
                    <img src="cabeca.png" alt="Logo do reizinho" class="site-logo">
                    <p class="hero-text-right">da aventura</p>
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
    <div class="linha-preta"></div>
    <div id="feedbacks" class="feedbacks">
        <div class="feedbacks-titulo">
            <h1> Feedbacks </h1>
            <p> Publique seu feedback sobre o nosso projeto Ticuliro! </p>
        </div>

        <?php if ($logged_in) : ?>

            <div class="feedbacks-publicar">
                <form method="POST">
                    <label for="conteudo">Escreva o feedback:</label>
                    <textarea></textarea>
                    <div class="enviar">
                        <span class="enviar_span">
                            <input type="button" class="input_enviar" value="Enviar">
                        </span>
                    </div>
                </form>
            </div>
        <?php endif; ?>
        <div class="feedbacks-publicados">
            <?php while ($row = $dados_feedback->fetch(PDO::FETCH_ASSOC)) : ?>
                <table>
                    <th>
                    <td><?php echo $row['nickname']; ?></td>
                    <td><?php echo $row['data']; ?></td>
                    </th>
                </table>
                <table class="feedbacks-publicados">
                    <tbody>
                        <td><?php echo $row['feedback']; ?></td>
                    </tbody>
                </table>
            <?php endwhile; ?>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
</body>

</html>