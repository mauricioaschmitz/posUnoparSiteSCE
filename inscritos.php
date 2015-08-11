<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require('include/bancoFunc.php');
require('include/funcoes.php');
$naologado = false;
$idCorreto = false;
$inscritos = '';

if (!(isset($_SESSION['cpf']) && $_SESSION['cpf'] != '')) {
    $naologado = true;
    header("Refresh: 3;url=entrar.php");
} else {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $idCorreto = true;
    $dados = leituraBD("idInscricao", "eventosInscricao", "WHERE idEventos='$id'");
    for ($i = 0; $i < count($dados); $i++) {
        $idInscrito = $dados[$i]['idInscricao'];
        $leitura = leituraBD("nome", "inscricao", "WHERE id='$idInscrito'");
        $inscritos[$i] = $leitura[0]['nome'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include_once ('include/cabecalho.php'); ?>
        <title>Detalhes do Evento</title>
    </head>
    <body>
        <?php
        include_once ('include/menu.php');
        if ($naologado) {
            echo funcAlert("Você deve entrar no sistema para alterar os dados! Aguarde enquanto é redirecionado para a página de Login!!!", "danger");
            exit();
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-0"></div>
                <div class="col-md-6 col-xs-12">
                    <table id="tabela" class="table table-striped">
                        <thead class="alert alert-warning">
                            <tr>
                                <th style="text-align: left">Nº</th>
                                <th style="text-align: left">Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($idCorreto) {
                                for ($i = 0; $i < count($inscritos); $i++) {
                                    echo "<tr class=''>";
                                    echo "<td style='text-align: left'>" . ($i+1) . "</td>";
                                    echo "<td style='text-align: left'>" . $inscritos[$i] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <form method="POST" action="detalhes.php?id=<?php echo $id?>">
                        <button type="submit" class="btn btn-primary">Voltar</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <?php include_once('include/rodape.php'); ?>
    </body>
</html>