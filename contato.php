<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require('include/funcoes.php');

$envia = '';
$email = '';
$mensagem = '';
$nome = '';
$assunto = '';
$fone = '';

if (isset(filter_input_array(INPUT_POST)['gravar'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
    $fone = filter_input(INPUT_POST, 'fone', FILTER_SANITIZE_STRING);
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
        if (isset(filter_input_array(INPUT_POST)['gravar'])) {
            if (empty($nome)) {
                echo funcAlert("O campo Nome é obrigatório.", "warning");
            } elseif (empty($email)){
                echo funcAlert("O campo E-mail é obrigatório.", "warning");
            } elseif (empty($fone)) {
                echo funcAlert("O campo Telefone é obrigatório.", "warning");
            } elseif (empty($assunto)){
                echo funcAlert("O campo Assunto é obrigatório.", "warning");
            }  elseif (empty($mensagem)){
                echo funcAlert("O campo Mensagem é obrigatório.", "warning");
            } else{
                $envia = "email.php";
            }
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form id="form_contato" action="<?php echo $envia;?>" method="post">
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <div class = "alert alert-info">
                                    Envie sua dúvida ou entre em contato pelo email <strong>mauricioantonioli@gmail.com</strong>
                                </div>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <label style="float: left">Nome</label>
                                <input class = "form-control" type="text" name="nome" id="nome" value="<?php
                                   if (isset($nome)) {
                                       echo $nome;
                                   }
                                   ?>" placeholder="Nome"/>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <label style="float: left">E-mail</label>
                                <input class = "form-control" type="text" name="email" id="email" value="<?php
                                   if (isset($email)) {
                                       echo $email;
                                   }
                                   ?>" placeholder="E-mail"/>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <label style="float: left">Telefone</label>
                                <input data-mask ="(99)9999-9999" class = "form-control" type="tel" name="fone" id="fone" value="<?php
                                   if (isset($fone)) {
                                       echo $fone;
                                   }
                                   ?>" placeholder="Telefone"/>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <label style="float: left">Assunto</label>
                                <input class = "form-control" type="text" name="assunto" id="assunto" value="<?php
                                   if (isset($assunto)) {
                                       echo $assunto;
                                   }
                                   ?>" placeholder="Assunto"/>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <label style="float: left" for="mensagem">Mensagem: </label>
                                <textarea rows="6" class="form-control" name="mensagem" id="mensagem" placeholder="Mensagem"><?php
                                   if (isset($mensagem)) {
                                       echo $mensagem;
                                   }
                                   ?></textarea>
                            </div>
                        </div>
                        <button type="submit" name="gravar" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once('include/rodape.php'); ?>
    </body>
</html>