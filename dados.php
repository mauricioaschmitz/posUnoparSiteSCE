<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require('include/bancoFunc.php');
require('include/funcoes.php');
$naologado = false;
$atualizado = false;
$cancelar = false;
if (!(isset($_SESSION['cpf']) && $_SESSION['cpf'] != '')) {
    $naologado = true;
    header("Refresh: 3;url=entrar.php");
} else {
    $cpf = $_SESSION['cpf'];
    $dados = leituraBD("*", "inscricao", "WHERE cpf='$cpf'");
    $nome = $dados[0]['nome'];
    $dataNasc = formataDataHTML($dados[0]['dataNasc']);
    $telefone = $dados[0]['telefone'];
    $email = $dados[0]['email'];
    $sexo = $dados[0]['sexo'];
    $estadoCivil = $dados[0]['estadoCivil'];
    $cep = $dados[0]['cep'];
    $cidade = $dados[0]['cidade'];
    $estado = $dados[0]['estado'];
    $bairro = $dados[0]['bairro'];
    $endereco = $dados[0]['endereco'];
    $numero = $dados[0]['numero'];
    $complemento = $dados[0]['complemento'];

    if (isset(filter_input_array(INPUT_POST)['atualizar'])) {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $dataNasc = filter_input(INPUT_POST, 'dataNasc', FILTER_SANITIZE_STRING);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
        $estadoCivil = filter_input(INPUT_POST, 'estadoCivil', FILTER_SANITIZE_STRING);
        $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
        $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
        $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
        $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
        $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
        $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);

        if ((empty($nome)) || (empty($dataNasc)) || (!validaData($dataNasc)) || (empty($telefone)) || (empty($email)) 
            || (!filter_var($email, FILTER_VALIDATE_EMAIL))){
        } else {
            if ($_SESSION['nome'] != $nome) {
                $nomeSession = explode(" ", $nome);
                $nomeTamanho = substr($nomeSession[0], 0, 15);
                $_SESSION['nome'] = $nomeTamanho;
            }
            $nascimento = formataDataBD($dataNasc);
            $dados = "nome = '$nome', dataNasc = '$nascimento', telefone = '$telefone', sexo = '$sexo', estadoCivil = '$estadoCivil', email = '$email', "
                    . "cep = '$cep', cidade = '$cidade', estado = '$estado', bairro = '$bairro', endereco = '$endereco', numero = '$numero', complemento = '$complemento'";
            $atualizar = atualizarBD('inscricao', $dados, "WHERE cpf='$cpf'");
            $atualizado = true;
            header("Refresh: 3;url=dados.php");
        }
    } elseif (isset(filter_input_array(INPUT_POST)['cancelar'])) {
        $cancelar = true;
        header("Refresh: 3;url=index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include_once ('include/cabecalho.php'); ?>
        <link rel="stylesheet" href="include/css/bootstrap.css">
        <title>Dados</title>
        <script src="include/js/inputmask.js"></script>
    </head>
    <body>
        <?php
        include_once('include/menu.php');
        if (isset(filter_input_array(INPUT_POST)['atualizar'])) {
            if (empty($nome)) {
                echo funcAlert("O Campo Nome é obrigatório!", "warning");
            } elseif (empty($dataNasc)) {
                echo funcAlert("O Campo Data de Nascimento é obrigatório!", "warning");
            } elseif (!validaData($dataNasc)) {
                echo funcAlert("Data de Nascimento inválida!", "danger");
            } elseif (empty($telefone)) {
                echo funcAlert("O Campo Telefone é obrigatório!", "warning");
            } elseif (empty($email)) {
                echo funcAlert("O Campo E-mail é obrigatório!", "warning");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo funcAlert("E-mail inválido!", "danger");
            }
            if ($atualizado) {
                echo funcAlert("Dados atualizados com sucesso! Aguarde!!!", "success");
            }
        }
        if ($naologado) {
            echo funcAlert("Você deve entrar no sistema para alterar os dados! Aguarde enquanto é redirecionado para a página de Login!!!", "danger");
        }
        if ($cancelar) {
            echo funcAlert("Saindo da página de alteração de dados do SCE! Aguarde!!!", "danger");
        }
        ?>
        <div class="col-md-12 col-xs-12" style="margin-bottom: 100px;">
            <div class="container">
                <form name="dados" method="post" enctype="multipart/form-data">
                    <div class="well well-sm">
                        <p><strong>Atenção! </strong>Atualize seus dados cadastrados e clique no botão <strong>Atualizar Dados</strong>.
                            Caso os dados já estejam corretos clique no botão <strong>Cancelar!</strong></p>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-xs-6 form-group">
                            <label>Nome Completo *</label>
                            <input class = "form-control" type="text" name="nome" id="nome" value="<?php
                            if (isset($nome)) {
                                echo $nome;
                            }
                            ?>" placeholder="Nome"/>
                        </div> 
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">Data de Nascimento *</label>
                            <input data-mask ="99/99/9999" class = "form-control" type="tel" name="dataNasc" id="data_nasc" value="<?php
                            if (isset($dataNasc)) {
                                echo $dataNasc;
                            }
                            ?>" placeholder="00/00/0000"/>
                        </div> 
                        <div class="col-md-3  col-xs-6 form-group">
                            <label style="float: left">Telefone *</label>
                            <input data-mask ="(99)9999-9999" class="form-control" type="tel" name="telefone" id="fone" value="<?php
                            if (isset($telefone)) {
                                echo $telefone;
                            }
                            ?>" placeholder="(00)0000-0000"/>
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="display: block;">Sexo</label>
                            <input class="radio-inline" type="radio" name="sexo" value="M" <?php
                            if ($sexo == "M") {
                                echo "checked";
                            }
                            ?>> Masculino
                            <input class="radio-inline" type="radio" name="sexo" value="F" <?php
                            if ($sexo == "F") {
                                echo "checked";
                            }
                            ?>> Feminino
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">Estado Civil</label>
                            <select class="form-control selectpicker span10" id="estadoCivil" name ="estadoCivil" data-live-search="true">
                                <option value="" <?php
                                if ($estadoCivil == "") {
                                    echo "selected";
                                }
                                ?>>Selecione</option>
                                <option value="Solteiro(a)" <?php
                                if ($estadoCivil == "Solteiro(a)") {
                                    echo "selected";
                                }
                                ?>>Solteiro(a)</option>
                                <option value="Casado(a)" <?php
                                if ($estadoCivil == "Casado(a)") {
                                    echo "selected";
                                }
                                ?>>Casado(a)</option>
                                <option value="Divorciado(a)" <?php
                                if ($estadoCivil == "Divorciado(a)") {
                                    echo "selected";
                                }
                                ?>>Divorciado(a)</option>
                                <option value="Viúvo(a)" <?php
                                if ($estadoCivil == "Viúvo(a)") {
                                    echo "selected";
                                }
                                ?>>Viúvo(a)</option>
                                <option value="Separado(a)" <?php
                                if ($estadoCivil == "Separado(a)") {
                                    echo "selected";
                                }
                                ?>>Separado(a)</option>
                                <option value="Companheiro(a)" <?php
                                if ($estadoCivil == "Companheiro(a)") {
                                    echo "selected";
                                }
                                ?>>Companheiro(a)</option>
                            </select> 
                        </div>
                        <div class="col-md-6 col-xs-6 form-group">
                            <label>Email *</label>
                            <input class = "form-control" type="email" name="email" id="email" value="<?php
                            if (isset($email)) {
                                echo $email;
                            }
                            ?>" placeholder="Email"/>
                        </div>  
                    </div>
                    <div class ="row">
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">CEP</label>
                            <input data-mask ="99999-999" class="form-control" type="text" name="cep" id="cep" value="<?php
                            if (isset($cep)) {
                                echo $cep;
                            }
                            ?>" placeholder="00000-000"/>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label>Cidade</label>
                            <input class="form-control" type="text" name="cidade" id="cidade" value="<?php
                            if (isset($cidade)) {
                                echo $cidade;
                            }
                            ?>" placeholder="Cidade"/>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label>Estado</label>
                            <input class="form-control" type="text" name="estado" id="estado" value="<?php
                            if (isset($estado)) {
                                echo $estado;
                            }
                            ?>" placeholder="Estado"/>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">Bairro</label>
                            <input class ="form-control" type="text" name="bairro" id="bairro" value="<?php
                            if (isset($bairro)) {
                                echo $bairro;
                            }
                            ?>" placeholder="Bairro"/>
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-md-6 col-xs-6 form-group">
                            <label>Endereço (Rua, Avenida, Outros)</label>
                            <input class="form-control" type="text" name="endereco" id="endereco" value="<?php
                            if (isset($endereco)) {
                                echo $endereco;
                            }
                            ?>" placeholder="Endereço"/>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label>Número</label>
                            <input class="form-control" type="tel" name="numero" id="numero" value="<?php
                            if (isset($numero)) {
                                echo $numero;
                            }
                            ?>" placeholder="Número"/>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label>Complemento</label>
                            <input class="form-control" type="text" name="complemento" id="complemento" value="<?php
                            if (isset($complemento)) {
                                echo $complemento;
                            }
                            ?>" placeholder="Complemento"/>
                        </div>
                    </div>
                    <br>
                    <button type="submit" name="atualizar" class="btn btn-success">Atualizar dados!</button>
                    <button type="submit" name="cancelar" class="btn btn-danger">Cancelar!</button>
                </form>
            </div>
        </div>
        <?php include_once('include/rodape.php');?>
    </body>
</html>