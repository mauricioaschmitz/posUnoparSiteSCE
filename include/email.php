<?php

include_once('include/menu.php');
require("include/PHPMailer5.2.0/class.PHPMailer.php");

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
    echo "Mensagem nao pode ser enviada! <p>";
    echo "Erro: " . $mail->ErrorInfo;
    exit;
}

echo "Mensagem enviada!";
?>
