<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="headerstyle.css">
    <title>King Can't Scape!</title>
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="index.php">
                <div class="imagemLogo">
                    <img class="logoi" src="cabeca.png" alt="Logo do jogo. Rei." width="60px" style="margin-top: 5px;">
                </div>
                <div class="nomeLogo">
                    <span class="Nome">King Can't Scape!</span>
                </div>
            </a>
        </div>

        <div class="btnHeader">
            <?php if($logged_in): ?>
                <a href="baixar.php" class="btn-download">Baixar</a>
            <?php else: ?>
                <a href="login.php" class="btn-download">Baixar</a>
            <?php endif; ?>
        </div>

        <div class="login">
            <?php if($logged_in): ?>
                <span>
                    <a href="consultUsu.php"> <?php echo $_SESSION['nickname']; ?> </a>
                    <a href="logout.php">
                        <div class="iconLogin">
                            Logout <!-- Você pode adicionar um ícone de logout aqui se desejar -->
                        </div>
                    </a>
                </span>
            <?php else: ?>
                <a href="login.php">
                    <span>
                        Login
                        <div class="iconLogin">
                            <!-- Se desejar, adicione um ícone de login aqui -->
                        </div>
                    </span>
                </a>
            <?php endif; ?>
        </div>
    </header>
</body>
</html>
