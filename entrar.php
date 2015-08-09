<?php
require ('include/bancoFunc.php');
require('include/funcoes.php');
$logado = false;
if (isset(filter_input_array(INPUT_POST)['entrar'])) { // Testa se o POST foi enviado pelo botão "entrar"
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    if (empty($cpf)) {
        echo funcAlert("O Campo CPF é obrigatório!", "warning");
    } elseif (!validaCPF($cpf)) {
        echo funcAlert("CPF inválido!", "danger");
    } elseif (empty($senha)) {
        echo funcAlert("O Campo Senha é obrigatório!", "warning");
    } else {
        //SELECIONA CANDIDATO DE ACORDO COM CPF PARA VER SE ELE JA FEZ SUA INSCRIÇÃO
        $dados = leituraBD("cpf, nome, senha", "inscricao", "WHERE cpf='$cpf'");
        //mysql_query("SELECT  FROM inscricao WHERE cpf='$cpf'");
        if ($dados) {
            if ($dados[0]['senha'] == $senha) {
                $nome = explode(" ", $dados[0]['nome']);
                $nomeTamanho = substr($nome[0], 0, 15);
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }
                $_SESSION['nome'] = $nomeTamanho;
                $_SESSION['cpf'] = $cpf;
                $logado = true;
                header("Refresh: 3;url=index.php");
            } else {
                echo funcAlert("Senha incorreta! Para ajuda <a href='contato.php'>clique aqui</a> ou tente novamente.", "warning");
            }
        } else {
            echo funcAlert("CPF não cadastrado no SCE! Para realizar o Cadastro <a href='cadastrar.php'>clique aqui.</a>", "warning");
        }
    }
} else {
    $cpf = '';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include_once('include/cabecalho.php'); ?>
        <title>Entrar</title>
        <script src="include/js/inputmask.js"></script>
    </head>
    <body id="entrar">
        <?php include_once('include/menu.php'); ?>        
        <div class="container">
            <?php
            if ($logado) {
                echo funcAlert("Autenticado com Sucesso! Aguarde redirecionamento para a página principal. "
                        . "Caso a página de principal não tenha carregado <a href='index.php'>clique aqui.</a>", "success");
            }
            ?>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                        <img class="profile-img" src="include/img/SCE.png"
                             alt="">
                        <form class="form-signin" method="post" action="" enctype="multipart/form-data">
                            <input type="text" class="form-control" data-mask="999.999.999-99" name="cpf" value="<?php
                            if (isset($cpf)) {
                                echo $cpf;
                            }
                            ?>" placeholder="CPF" >
                            <input type="password" class="form-control" name="senha" placeholder="Senha" >
                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="entrar">
                                Entrar</button>
                            <a href="contato.php" class="pull-right need-help">Precisa de ajuda? </a><span class="clearfix"></span>
                        </form>
                    </div>
                    <a href="cadastrar.php" class="text-center new-account">Criar conta! </a>
                </div>
            </div>
<?php include_once('include/rodape.php'); ?>
        </div>
    </body>
</html>