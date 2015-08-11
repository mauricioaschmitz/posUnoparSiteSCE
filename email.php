<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require('include/PHPMailer/class.phpmailer.php');
require('include/PHPMailer/class.smtp.php');
require('include/funcoes.php');

$emailNaoEnviado = false;

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
$fone = filter_input(INPUT_POST, 'fone', FILTER_SANITIZE_STRING);

$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';

$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "sce@caxias.ifrs.edu.br";
$mail->Password = "Pu8R>j2M";

$mail->From = $email;
$mail->FromName = $nome;
$mail->AddAddress("mauricioschmitz@me.com", "Maurício Antonioli Schmitz");

$mail->Subject = $assunto;
$mail->Body = "Email: " . $email . " Telefone: " . $fone . " Mensagem: " . $mensagem;
$mail->IsHTML(true);

if (!$mail->Send()) {
    $emailNaoEnviado = true;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include_once ('include/cabecalho.php'); ?>
        <title>Contato</title>
        <script src="include/js/inputmask.js"></script>
    </head>
    <body id="contato">
        <?php
        include_once('include/menu.php');
        if ($emailNaoEnviado) {
            $erro = "Mensagem não pode ser enviada. Erro: " . $mail->ErrorInfo;
            echo funcAlert($erro, "warning");
            exit();
        } else {
            echo funcAlert("E-mail enviado com sucesso! <a href='index.php'>Clique aqui</a> para voltar a página inicial.", "success");
            exit();
        }
        include_once('include/rodape.php');
        ?>
    </body>
</html>
