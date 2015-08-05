<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once ('include/cabecalho.php'); ?>
        <title>Entrar</title>
        <script src="include/js/inputmask.js"></script>
    </head>
    <body>
        <?php
        include_once ('include/menu.php');
        require('include/funcoes.php');
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        unset($_SESSION['cpf']);
        unset($_SESSION['senha']);
        unset($_SESSION['nome']);
        session_destroy();
        session_write_close();
        echo funcAlert("Saindo do SCE! Aguarde!!!", "danger");
        header("Refresh: 3;url=index.php");
        ?>
    </body>
</html>