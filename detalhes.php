<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require('include/bancoFunc.php');
require('include/funcoes.php');
$naologado = false;
$idInvalido = false;
$idCorreto = false;
$inscreveu = false;
$cadastrado = false;
$naoHaVagas = false;

if (!(isset($_SESSION['cpf']) && $_SESSION['cpf'] != '')) {
    $naologado = true;
    header("Refresh: 3;url=entrar.php");
} else {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $idCorreto = true;
    $dados = leituraBD("*", "eventos", "WHERE id = '$id'");
    $tblCampos[1] = "Nome";
    $tblCampos[2] = "Data do Evento";
    $tblCampos[3] = "Data Limite para Inscrição";
    $tblCampos[4] = "Tipo de Evento";
    $tblCampos[5] = "Horário de Início";
    $tblCampos[6] = "Duração";
    $tblCampos[7] = "Número de Vagas";
    $tblCampos[8] = "CEP";
    $tblCampos[9] = "Cidade";
    $tblCampos[10] = "Estado";
    $tblCampos[11] = "Bairro";
    $tblCampos[12] = "Endereço";
    $tblCampos[13] = "Número";
    $tblCampos[14] = "Complemento";
    $tblCampos[15] = "";
    $tblCampos[16] = "Descrição do Evento";
    if (isset(filter_input_array(INPUT_POST)['inscrever'])) {
        $idSessao = $_SESSION['id'];
        $vagas = leituraBD("vagas", "eventos", "WHERE id = '$id'");
        if (leituraBD("*", "eventosInscricao", "WHERE idEventos = '$id' AND  idInscricao='$idSessao'")) {
            $cadastrado = true;
        } elseif($vagas[0]['vagas'] > 0){
            $inserir = array(
                'idEventos' => $id,
                'idInscricao' => $idSessao
            );
            $insere = inserirBD("eventosInscricao", $inserir);
            $novasVagas = $vagas[0]['vagas']-1;
            $atualizar = atualizarBD("eventos", "vagas='$novasVagas'", "WHERE id = '$id'");
            $inscreveu = true;
            header("Refresh: 3;url=index.php");
        } else {
            $naoHaVagas = true;
        }
    }
    if (isset(filter_input_array(INPUT_POST)['voltar'])) {
        header("Refresh: 0;url=eventos.php");
    }
    if (isset(filter_input_array(INPUT_POST)['inscritos'])) {
        header("Refresh: 0;url=inscritos.php?id=".$id);
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
        if ($idInvalido) {
            echo funcAlert("ID Inválido! Aguarde enquanto é redirecionado para a página de Login!!!", "danger");
            exit();
        }
        if ($inscreveu) {
            echo funcAlert("Inscrição realizada com sucesso! Aguarde enquanto é redirecionado para a página inicial!", "success");
            exit();
        }
        if ($cadastrado) {
            echo funcAlert("Você já realizou a inscrição para esse evento! Para voltar a página de eventos <a href='eventos.php'>clique aqui!</a>!", "warning");
            exit();
        }
        if ($naoHaVagas) {
            echo funcAlert("Não há mais vagas para o evento! Para voltar a página de eventos <a href='eventos.php'>clique aqui!</a>!", "warning");
            exit();
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-0"></div>
                <div class="col-md-6 col-xs-12">
                    <table id="tabela" class="table table-striped">
                        <thead class="alert alert-success">
                            <tr>
                                <th class="col-md-2 col-xs-6" style="text-align: left">Campo</th>
                                <th class="col-md-4 col-xs-6" style="text-align: left">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($idCorreto) {
                                $campos = array_keys($dados[0]);
                                $dados[0]['dataEvento'] = formataDataHTML($dados[0]['dataEvento']);
                                $dados[0]['dataInscricao'] = formataDataHTML($dados[0]['dataInscricao']);
                                
                                for ($i = 1; $i < count($campos); $i++) {
                                    if($i == 15)
                                        continue;
                                    echo "<tr class=''>";
                                    echo "<td style='text-align: left'>" . $tblCampos[$i] . "</td>";
                                    echo "<td style='text-align: left'>" . $dados[0][$campos[$i]] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class='row'>
                <div class="col-md-3 col-xs-0"></div>
                <div class='col-md-6 col-xs-12'>
                    <form method="POST">
                        <button type="submit" class="btn btn-success" name="inscrever">Inscrever-se</button>
                        <button type="submit" class="btn btn-primary" name="voltar">Voltar</button>
                        <button type="submit" class="btn btn-info" name="inscritos">Visualizar Inscritos</button>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once('include/rodape.php'); ?>
    </body>
</html>