<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require('include/bancoFunc.php');
require('include/funcoes.php');
$naologado = false;
$deletar = false;
$senhaErrada = false;
if (!(isset($_SESSION['cpf']) && $_SESSION['cpf'] != '')) {
    $naologado = true;
    header("Refresh: 3;url=entrar.php");
    exit();
} else {
    if (isset(filter_input_array(INPUT_POST)['apagar'])) {
        $cpf = $_SESSION['cpf'];
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        $verificaSenha = leituraBD("*", "inscricao", "WHERE cpf='$cpf' AND senha='$senha'");
        if ($verificaSenha) {
            $id = $_SESSION['id'];
            $condicao = "WHERE id='$id'";
            $deletar = deletarBD("inscricao", $condicao);
            header("Refresh: 3;url=sair.php");          
        } else {
            $senhaErrada = true;
        }
    } elseif (isset(filter_input_array(INPUT_POST)['voltar'])) {
        header("Refresh: 0;url=index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include_once ('include/cabecalho.php'); ?>
        <title>Apagar Conta</title>
    </head>
    <body>
        <?php include_once('include/menu.php'); 
        if ($naologado) {
            echo funcAlert("Você deve entrar no sistema para alterar os dados! Aguarde enquanto é redirecionado para a página de Login!!!", "danger");
        }
        if($senhaErrada){
            echo funcAlert("Confirmação de Senha incorreta, para apagar a conta digite a sua senha e pressione o botão <strong>Apagar conta!</strong>", "warning");
        }
        if ($deletar) {
            echo funcAlert("Conta deletada com Sucesso! Aguarde enquanto é redirecionado para a página de Inicial!!!", "success");
        }
        ?>
        <div class="container">
            <form name="apagar" method="post" enctype="multipart/form-data">
                <div class ="row">
                    <div class="well well-sm col-md-12 col-xs-12">
                        <strong>Atenção! </strong>Esta ação é permanete e não poderá ser revertida. Para apagar sua conta confirme sua senha no campo abaixo e pressione o botão <strong>Apagar conta!</strong>
                        <br>
                        Se não desejar apagar a conta pressione o botão <strong>Voltar!</strong> para retornar a página inicial!
                    </div>
                </div>
                <div class ="row">
                    <div class="col-md-3 col-xs-6 form-group">
                        <label style="float: left">Confirmar Senha</label>
                        <input class = "form-control" type="password" name="senha" id="senha" value="<?php
                        if (isset($senha)) {
                            echo $senha;
                        }
                        ?>" placeholder="Confirme sua Senha"/>
                    </div>
                </div>
                <button type="submit" name="apagar" class="btn btn-danger">Apagar conta!</button>
                <button type="submit" name="voltar" class="btn btn-info">Voltar!</button>
            </form>
        </div>
        <?php include_once('include/rodape.php'); ?>
    </body>
</html>