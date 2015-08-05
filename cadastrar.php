<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once ('include/cabecalho.php'); ?>
        <title>Inscrição</title>
        <script src="include/js/inputmask.js"></script>
    </head>
    <body id="cadastrar">
        <?php
        require('include/bancoFunc.php');
        require('include/funcoes.php');
        include_once('include/menu.php');
        if (isset(filter_input_array(INPUT_POST)['cadastrar'])) {
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
            $senhaConfirmar = filter_input(INPUT_POST, 'senhaConfirmar', FILTER_SANITIZE_STRING);
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
            if (empty($cpf)) {
                echo funcAlert("O Campo CPF é obrigatório!", "warning");
            } elseif (!validaCPF($cpf)) {
                echo funcAlert("CPF obrigatório!", "danger");
            } elseif (leituraBD("cpf", "inscricao", "WHERE cpf='$cpf'")) {
                echo funcAlert("CPF já cadastrado. Redirecionando para página de Login. Aguarde...", "success");
                header("Refresh: 3;url=index.php");
                exit();
            } elseif (empty($senha)) {
                echo funcAlert("O Campo Senha é obrigatório!", "warning");
            } elseif (empty($senhaConfirmar)) {
                echo funcAlert("O Campo Confirmar Senha é obrigatório!", "warning");
            } elseif ($senha != $senhaConfirmar) {
                echo funcAlert("As senhas devem ser iguais!", "warning");
            } elseif (empty($nome)) {
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
            } else {
                $nascimento = formataDataBD($dataNasc);
                $dados = array(
                    'cpf' => $cpf,
                    'senha' => $senha,
                    'nome' => $nome,
                    'dataNasc' => $nascimento,
                    'telefone' => $telefone,
                    'sexo' => $sexo,
                    'estadoCivil' => $estadoCivil,
                    'email' => $email,
                    'cep' => $cep,
                    'cidade' => $cidade,
                    'estado' => $estado,
                    'bairro' => $bairro,
                    'endereco' => $endereco,
                    'numero' => $numero,
                    'complemento' => $complemento
                );
                $insere = inserirBD('inscricao', $dados);
                echo funcAlert("PARABÉNS! Cadastro no SCE realizado com sucesso! Redirecionando para a página de Login. Aguarde!!!", "success");
                header("Refresh: 3;url=entrar.php");
                exit();
            }
        } elseif (isset(filter_input_array(INPUT_POST)['cancelar'])) {
            echo funcAlert("Saindo da página de cadastro do SCE! Aguarde!!!", "danger");
            header("Refresh: 3;url=index.php");
            exit();
        } else {
            $cpf = '';
            $senha = '';
            $senhaConfirmar = '';
            $nome = '';
            $dataNasc = '';
            $telefone = '';
            $email = '';
            $sexo = '';
            $estadoCivil = '';
            $cep = '';
            $cidade = '';
            $estado = '';
            $bairro = '';
            $endereco = '';
            $numero = '';
            $complemento = '';
        }
        ?>
        <div class="container">
            <div class="col-md-12 col-xs-12" style="margin-bottom: 100px;">
                <form name="registros" method="post" enctype="multipart/form-data">
                    <div class="well well-sm">
                        <p><strong>Atenção! </strong>Preencha o Formulário abaixo para realizar sua inscrição no SCE.
                            Caso já possua cadastro efetue Login no menu acima ou <a href="entrar.php">clique aqui</a> para ser redirecionado.</p>
                        <p>A identificação do usuário é realizada através do número do CPF, portanto para Cadastro e Login no sistema utilize seu CPF. <strong>Os campos marcados com * são obrigatórios.</strong></p>
                    </div>
                    <div class ="row">                  
                        <div class="col-md-6 col-xs-6 form-group">
                            <label style="float: left">CPF *</label>
                            <input data-mask="999.999.999-99" class = "form-control" type="text" name="cpf" id="cpf" value="<?php
                            if (isset($cpf)) {
                                echo $cpf;
                            }
                            ?>" placeholder="000.000.000-00" autofocus=""/>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">Senha *</label>
                            <input class = "form-control" type="password" name="senha" id="senha" value="<?php
                            if (isset($senha)) {
                                echo $senha;
                            }
                            ?>" placeholder="Senha"/>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">Confirmar Senha *</label>
                            <input class = "form-control" type="password" name="senhaConfirmar" id="senhaConfirmar" value="<?php
                            if (isset($senhaConfirmar)) {
                                echo $senhaConfirmar;
                            }
                            ?>" placeholder="Confirmar Senha"/>
                        </div>
                    </div>
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
                            <select id="estadoCivil" name ="estadoCivil" class="form-control selectpicker span10" data-live-search="true">
                                <option value=""<?php
                                if ($estadoCivil == "") {
                                    echo " selected";
                                }
                                ?>>Selecione</option>
                                <option value="Solteiro(a)"<?php
                                if ($estadoCivil == "Solteiro(a)") {
                                    echo " selected";
                                }
                                ?>>Solteiro(a)</option>
                                <option value="Casado(a)"<?php
                                if ($estadoCivil == "Casado(a)") {
                                    echo " selected";
                                }
                                ?>>Casado(a)</option>
                                <option value="Divorciado(a)"<?php
                                if ($estadoCivil == "Divorciado(a)") {
                                    echo " selected";
                                }
                                ?>>Divorciado(a)</option>
                                <option value="Viúvo(a)"<?php
                                if ($estadoCivil == "Viúvo(a)") {
                                    echo " selected";
                                }
                                ?>>Viúvo(a)</option>
                                <option value="Separado(a)"<?php
                                if ($estadoCivil == "Separado(a)") {
                                    echo " selected";
                                }
                                ?>>Separado(a)</option>
                                <option value="Companheiro(a)"<?php
                                if ($estadoCivil == "Companheiro(a)") {
                                    echo " selected";
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
                    <button type="submit" name="cadastrar" class="btn btn-success">Enviar dados!</button>
                    <button type="submit" name="cancelar" class="btn btn-danger">Cancelar!</button>
                </form>
            </div>
        </div>   
    </body>
</html>
